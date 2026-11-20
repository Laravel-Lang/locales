<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Services;

use Illuminate\Support\Collection;
use LaravelLang\Config\Services\AliasLangConfig;
use LaravelLang\Exceptions\UnknownLocaleException;
use LaravelLang\Filesystem\Filesystem;
use LaravelLang\LocaleList\Locale;
use LaravelLang\NativeLocaleNames\LocaleData;
use LaravelLang\NativeLocaleNames\LocaleNames;

use function app;
use function in_array;
use function lang_path;
use function pathinfo;

class LocalesService
{
    public function __construct(
        protected AliasLangConfig $aliasConfig,
        protected LocaleNames $localeNames,
        protected Filesystem $filesystem,
    ) {}

    public function data(): LocalesDataService
    {
        return app()->make(LocalesDataService::class);
    }

    public function available(bool $aliased = true): Collection
    {
        return Locale::collection()
            ->when($aliased, fn (Collection $items) => $items->map(
                fn (string $locale) => $this->toAlias($locale)
            ))
            ->sort()
            ->values();
    }

    public function installed(bool $aliased = true): Collection
    {
        $protects = $this->protects($aliased);

        $items  = $this->filesystem->glob(lang_path('*'));
        $vendor = $this->filesystem->glob(lang_path('vendor/*/*.json'));

        return (new Collection($items))
            ->merge($vendor)
            ->map(function (string $path) use ($aliased): string {
                $locale = pathinfo($path, PATHINFO_FILENAME);

                return $aliased
                    ? $this->toAlias($locale)
                    : $this->fromAlias($locale);
            })
            ->filter(fn (string $locale) => $this->isAvailable($locale))
            ->merge($protects)
            ->unique()
            ->sort()
            ->values();
    }

    public function uninstalled(bool $aliased = true): Collection
    {
        return Locale::collection()
            ->diff($this->installed(false))
            ->when($aliased, fn (Collection $items) => $items->map(
                fn (string $locale) => $this->toAlias($locale)
            ))
            ->sort()
            ->values();
    }

    public function protects(bool $aliased = true): Collection
    {
        return (new Collection([
            $this->current($aliased),
            $this->fallback($aliased),
        ]))->unique()->values();
    }

    public function current(bool $aliased = true): string
    {
        $locale = app()->getLocale();

        if ($this->isAvailable($locale)) {
            return $aliased
                ? $this->toAlias($locale)
                : $this->fromAlias($locale);
        }

        return $this->fallback($aliased);
    }

    public function fallback(bool $aliased = true): string
    {
        $locale = app()->getFallbackLocale();

        if ($this->isAvailable($locale)) {
            return $aliased
                ? $this->toAlias($locale)
                : $this->fromAlias($locale);
        }

        if ($aliased) {
            return $this->toAlias(Locale::English);
        }

        return Locale::English->value;
    }

    public function isAvailable(Locale|LocaleData|string|null $locale): bool
    {
        if (! $locale) {
            return false;
        }

        return in_array($this->fromAlias($locale), Locale::values(), true);
    }

    public function isInstalled(Locale|LocaleData|string|null $locale): bool
    {
        if (! $locale) {
            return false;
        }

        return $this->installed(false)->contains(
            $this->fromAlias($locale)
        );
    }

    public function isProtected(Locale|LocaleData|string|null $locale): bool
    {
        if (! $locale) {
            return false;
        }

        return $this->protects(false)->contains(
            $this->fromAlias($locale)
        );
    }

    public function info(Locale|LocaleData|string|null $locale = null): LocaleData
    {
        $locale ??= $this->current(false);

        $normalized = $this->fromAlias($locale);

        if (! $this->isAvailable($normalized)) {
            throw new UnknownLocaleException($normalized);
        }

        return $this->localeNames->one($this->current(), $normalized);
    }

    public function set(Locale|LocaleData|string|null $locale): void
    {
        if (! $this->isInstalled($locale)) {
            return;
        }

        app()->setLocale(
            $this->fromAlias($locale)
        );
    }

    public function reload(): void
    {
        app()->forgetInstance('translator');
    }

    public function fromAlias(Locale|LocaleData|string|null $locale = null): ?string
    {
        $locale ??= $this->current();

        return $this->aliasConfig->from($locale);
    }

    public function toAlias(Locale|LocaleData|string|null $locale = null): ?string
    {
        $locale ??= $this->current();

        return $this->aliasConfig->to($locale);
    }
}
