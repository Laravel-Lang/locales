<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Data\NativeData;
use LaravelLang\NativeCountryNames\Native as NativeCountry;
use LaravelLang\NativeCurrencyNames\Native as NativeCurrency;
use LaravelLang\NativeLocaleNames\Native as NativeLocale;

trait Localized
{
    public function localizedLocales(): NativeData
    {
        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            NativeLocale::get(Locale::English),
            NativeLocale::get(),
            NativeLocale::get($this->appLocale())
        ));
    }

    public function localizedCountries(): NativeData
    {
        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            NativeCountry::get(Locale::English),
            NativeCountry::get(),
            NativeCountry::get($this->appLocale())
        ));
    }

    public function localizedCurrencies(): NativeData
    {
        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            NativeCurrency::get(Locale::English),
            NativeCurrency::get(),
            NativeCurrency::get($this->appLocale())
        ));
    }

    protected function appLocale(): string
    {
        return $this->fromAlias(
            $this->raw->getDefault()
        );
    }
}
