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

class MainService
{
    public function __construct(
        protected AliasLangConfig $aliasConfig,
        protected LocaleNames $localeNames,
        protected Filesystem $filesystem,
    ) {}

    public function data(): DataService
    {
        return app()->make(DataService::class);
    }

    /** @return Collection<int, string> */
    public function available(bool $aliased = true): Collection
    {
        return Locale::collection()
            ->when($aliased, fn (Collection $items) => $items->map(
                fn (string $locale): string => $this->formatLocale($locale, aliased: true)
            ))
            ->sort()
            ->values();
    }

    /** @return Collection<int, string> */
    public function installed(bool $aliased = true): Collection
    {
        $protects = $this->protects($aliased);

        $items  = $this->filesystem->glob(lang_path('*'));
        $vendor = $this->filesystem->glob(lang_path('vendor/*/*.json'));

        return (new Collection($items))
            ->merge($vendor)
            ->map(function (string $path) use ($aliased): string {
                $locale = pathinfo($path, PATHINFO_FILENAME);

                return $this->formatLocale($locale, $aliased);
            })
            ->filter(fn (string $locale): bool => $this->isAvailable($locale))
            ->merge($protects)
            ->unique()
            ->sort()
            ->values();
    }

    /** @return Collection<int, string> */
    public function uninstalled(bool $aliased = true): Collection
    {
        return Locale::collection()
            ->diff($this->installed(false))
            ->when($aliased, fn (Collection $items) => $items->map(
                fn (string $locale): string => $this->formatLocale($locale, aliased: true)
            ))
            ->sort()
            ->values();
    }

    /** @return Collection<int, string> */
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
            return $this->formatLocale($locale, $aliased);
        }

        return $this->fallback($aliased);
    }

    public function fallback(bool $aliased = true): string
    {
        $locale = app()->getFallbackLocale();

        if ($this->isAvailable($locale)) {
            return $this->formatLocale($locale, $aliased);
        }

        if ($aliased) {
            return $this->formatLocale(Locale::English->value, aliased: true);
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
        $normalized = $locale ? $this->fromAlias($locale) : null;

        return $normalized !== null && $this->installed(false)->contains($normalized);
    }

    public function isProtected(Locale|LocaleData|string|null $locale): bool
    {
        $normalized = $locale ? $this->fromAlias($locale) : null;

        return $normalized !== null && $this->protects(false)->contains($normalized);
    }

    public function info(Locale|LocaleData|string|null $locale = null): LocaleData
    {
        $locale ??= $this->current(false);

        $normalized = $this->fromAlias($locale);

        if ($normalized === null || ! $this->isAvailable($normalized)) {
            throw new UnknownLocaleException($normalized ?? $locale);
        }

        return $this->localeNames->one($this->current(), $normalized);
    }

    public function set(Locale|LocaleData|string|null $locale): void
    {
        $normalized = $locale ? $this->fromAlias($locale) : null;

        if ($normalized === null || ! $this->isInstalled($locale)) {
            return;
        }

        app()->setLocale($normalized);
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

    protected function formatLocale(string $locale, bool $aliased): string
    {
        $result = $aliased
            ? $this->toAlias($locale)
            : $this->fromAlias($locale);

        return $result ?? $locale;
    }
}
