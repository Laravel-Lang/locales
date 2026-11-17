<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Services;

use Illuminate\Support\Collection;
use LaravelLang\Config\Services\AliasConfig;
use LaravelLang\Exceptions\UnknownLocaleException;
use LaravelLang\Filesystem\Filesystem;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Concerns\Application;
use LaravelLang\Locales\Concerns\Localized;
use LaravelLang\Locales\Concerns\Mapping;
use LaravelLang\NativeLocaleNames\LocaleData;
use LaravelLang\NativeLocaleNames\LocaleNames;

use function app;
use function lang_path;
use function pathinfo;

class LocalesService
{
    use Application;
    use Localized;
    use Mapping;

    public function __construct(
        protected RawLocales $raw,
        protected AliasConfig $aliasConfig,
        protected LocaleNames $localeNames,
        protected Filesystem $filesystem,
    ) {}

    public function available(): Collection
    {
        return (new Collection(Locale::values()))
            ->map(fn (string $locale) => $this->aliasConfig->to($locale))
            ->sort()
            ->values();
    }

    public function installed(): Collection
    {
        $protects = $this->protects();

        $items  = $this->filesystem->glob(lang_path('*'));
        $vendor = $this->filesystem->glob(lang_path('vendor/*/*.json'));

        return (new Collection($items))
            ->merge($vendor)
            ->map(fn (string $path) => $this->aliasConfig->to(pathinfo($path, PATHINFO_FILENAME)))
            ->filter(fn (string $locale) => $this->isAvailable($locale))
            ->merge($protects)
            ->unique()
            ->sort()
            ->values();
    }

    public function uninstalled(): Collection
    {
        $installed = $this->installed()->map(
            fn (string $locale) => $this->aliasConfig->from($locale)
        );

        return (new Collection(Locale::values()))
            ->diff($installed)
            ->map(fn (string $locale) => $this->aliasConfig->to($locale))
            ->sort()
            ->values();
    }

    public function protects(): Collection
    {
        return (new Collection([
            $this->current(),
            $this->fallback(),
        ]))->unique()->values();
    }

    public function isAvailable(Locale|LocaleData|string|null $locale): bool
    {
        return $this->raw->isAvailable($locale);
    }

    public function isInstalled(Locale|LocaleData|string|null $locale): bool
    {
        return $this->raw->isInstalled($locale);
    }

    public function isProtected(Locale|LocaleData|string|null $locale): bool
    {
        return $this->raw->isProtected($locale);
    }

    public function info(Locale|LocaleData|string|null $locale = null): LocaleData
    {
        $locale ??= $this->current();

        $normalized = $this->aliasConfig->from($locale);

        if (! $this->isAvailable($normalized)) {
            throw new UnknownLocaleException($normalized);
        }

        return $this->localeNames->one($this->current(), $normalized);
    }

    public function current(): string
    {
        $locale = app()->getLocale();

        if ($this->isAvailable($locale)) {
            return $this->aliasConfig->to($locale);
        }

        return $this->fallback();
    }

    public function fallback(): string
    {
        $locale = app()->getFallbackLocale();

        return $this->isAvailable($locale)
            ? $this->aliasConfig->to($locale)
            : $this->aliasConfig->to(Locale::English);
    }

    public function set(Locale|LocaleData|string|null $locale): void
    {
        if (! $this->isInstalled($locale)) {
            return;
        }

        app()->setLocale(
            $this->aliasConfig->from($locale)
        );
    }

    public function fromAlias(Locale|LocaleData|string|null $locale = null): string
    {
        $locale ??= $this->current();

        return $this->aliasConfig->from($locale);
    }

    public function toAlias(Locale|LocaleData|string|null $locale = null): string
    {
        $locale ??= $this->current();

        return $this->aliasConfig->to($locale);
    }

    public function reload(): void
    {
        app()->forgetInstance('translator');
    }
}
