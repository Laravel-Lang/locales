<?php


declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use LaravelLang\Locales\Data\NativeData;
use LaravelLang\NativeCountryNames\CountryNames;
use LaravelLang\NativeCurrencyNames\CurrencyNames;
use LaravelLang\NativeLocaleNames\LocaleNames;

trait Localized
{
    public function localizedLocales(): NativeData
    {
        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            LocaleNames::get(),
            LocaleNames::get($this->appLocale())
        ));
    }

    public function localizedCountries(bool $withCountries): ?NativeData
    {
        if (! $withCountries) {
            return null;
        }

        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            CountryNames::get()->all(),
            CountryNames::get($this->appLocale())->all()
        ));
    }

    public function localizedCurrencies(bool $withCurrencies): ?NativeData
    {
        if (! $withCurrencies) {
            return null;
        }

        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            CurrencyNames::get()->all(),
            CurrencyNames::get($this->appLocale())->all()
        ));
    }
}
