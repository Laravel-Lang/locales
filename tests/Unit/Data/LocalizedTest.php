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

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;
use LaravelLang\NativeCountryNames\Native as NativeCountry;
use LaravelLang\NativeCurrencyNames\Data\CurrencyData;
use LaravelLang\NativeCurrencyNames\Native as NativeCurrency;
use LaravelLang\NativeLocaleNames\Native as NativeLocale;

it('checks language localization', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    // Locales
    $nativeLocale    = NativeLocale::get();
    $englishLocale   = NativeLocale::get(Locale::English);
    $localizedLocale = NativeLocale::get($locale);

    // Country
    $nativeCountry    = NativeCountry::get();
    $englishCountry   = NativeCountry::get(Locale::English);
    $localizedCountry = NativeCountry::get($locale);

    // Currency
    /** @var array<string, CurrencyData> $nativeCurrency */
    $nativeCurrency    = NativeCurrency::get();
    $englishCurrency   = NativeCurrency::get(Locale::English);
    $localizedCurrency = NativeCurrency::get($locale);

    foreach (Locales::available() as $item) {
        // Locales
        expect($item->name)->toBe($englishLocale[$item->code]);
        expect($item->native)->toBe($nativeLocale[$item->code]);
        expect($item->localized)->toBe($localizedLocale[$item->code]);

        // Country
        expect($item->country->code)->toBe($englishCurrency[$item->code]->country);
        expect($item->country->name)->toBe($englishCountry[$item->code]);
        expect($item->country->native)->toBe($nativeCountry[$item->code]);
        expect($item->country->localized)->toBe($localizedCountry[$item->code]);

        // Currency
        expect($item->currency->code)->toBe($englishCurrency[$item->code]->code);
        expect($item->currency->numericCode)->toBe($englishCurrency[$item->code]->numeric);

        expect($item->currency->name)->toBe($englishCurrency[$item->code]->name);
        expect($item->currency->native)->toBe($nativeCurrency[$item->code]->native);
        expect($item->currency->localized)->toBe($localizedCurrency[$item->code]->localized);
    }
})->with('locales');

it(
    'manually checks the localization of locales',
    function (
        string $locale,
        string $forLocale,
        string $name,
        string $native,
        string $localized,
        string $countryCode,
        string $countryName,
        string $countryNative,
        string $countryLocalized,
        string $currencyCode,
        int $currencyNumericCode,
        string $currencyName,
        string $currencyNative,
        string $currencyLocalized,
    ) {
        setLocales($forLocale);

        expect(app()->getLocale())->toBe($forLocale);
        expect(Locales::getDefault()->code)->toBe($forLocale);

        expect(Locales::info($locale))
            ->code->toBe($locale)
            ->name->toBe($name)
            ->native->toBe($native)
            ->localized->toBe($localized)
            // Country
            ->country->code->toBe($countryCode)
            ->country->name->toBe($countryName)
            ->country->native->toBe($countryNative)
            ->country->localized->toBe($countryLocalized)
            // Currency
            ->currency->code->toBe($currencyCode)
            ->currency->numericCode->toBe($currencyNumericCode)
            ->currency->name->toBe($currencyName)
            ->currency->native->toBe($currencyNative)
            ->currency->localized->toBe($currencyLocalized);
    }
)->with('localized');
