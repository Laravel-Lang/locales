<?php


declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use Illuminate\Support\Collection;
use LaravelLang\Config\Services\MapLangConfig;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Data\LocaleData;

trait Mapping
{
    protected function map(string $locale, bool $withCountry, bool $withCurrency): LocaleData
    {
        $locale = $this->findLocale($locale);

        return new LocaleData(
            $locale,
            $this->mapData($locale),
            $this->localizedLocales(),
            $this->localizedCountries($withCountry),
            $this->localizedCurrencies($withCurrency)
        );
    }

    protected function mapLocales(array $locales, bool $withCountries, bool $withCurrencies): Collection
    {
        return collect($locales)->map(
            fn (string $locale) => $this->map($locale, $withCountries, $withCurrencies)
        );
    }

    protected function findLocale(string $locale): Locale
    {
        return Locale::tryFrom($this->aliasConfig->to($locale))
            ?: Locale::tryFrom($this->aliasConfig->from($locale))
                ?: Locale::English;
    }

    protected function mapData(Locale $locale): array
    {
        return app(MapLangConfig::class)->get($locale);
    }
}
