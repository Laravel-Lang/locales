<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2024 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Data\LocaleData;
use LaravelLang\Locales\Data\NativeData;
use LaravelLang\NativeCountryNames\CountryNames;
use LaravelLang\NativeCurrencyNames\CurrencyNames;
use LaravelLang\NativeLocaleNames\LocaleNames;

function simpleData(Collection $locales): array
{
    return $locales->pluck('code')->all();
}

function fakeLocaleData(Locale $locale): LocaleData
{
    return new LocaleData(
        locale    : $locale,
        data      : [],
        locales   : new NativeData(LocaleNames::get(), LocaleNames::get($locale->value)),
        countries : new NativeData(CountryNames::get()->all(), CountryNames::get($locale->value)->all()),
        currencies: new NativeData(CurrencyNames::get()->all(), CurrencyNames::get($locale->value)->all())
    );
}
