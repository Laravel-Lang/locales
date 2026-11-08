<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2025 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

use LaravelLang\Locales\Facades\Locales;
use LaravelLang\NativeCountryNames\CountryNames;
use LaravelLang\NativeCountryNames\Data\CountryData;
use LaravelLang\NativeCurrencyNames\CurrencyNames;
use LaravelLang\NativeCurrencyNames\Data\CurrencyData;
use LaravelLang\NativeLocaleNames\LocaleNames;

it('checks locales', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    // Locales
    /**
     * @var array<string, string> $nativeLocale
     */
    $nativeLocale = LocaleNames::get();
    $localizedLocale = LocaleNames::get($locale);

    // Country
    /**
     * @var array<string, CountryData> $nativeCountry
     */
    $nativeCountry = CountryNames::get()->all();
    $localizedCountry = CountryNames::get($locale)->all();

    // Currency
    /**
     * @var array<string, CurrencyData> $nativeCurrency
     */
    $nativeCurrency = CurrencyNames::get()->all();
    $localizedCurrency = CurrencyNames::get($locale)->all();

    foreach (Locales::available(true, true) as $item) {
        // Locales
        expect($item->native)->toBe($nativeLocale[$item->code]);
        expect($item->localized)->toBe($localizedLocale[$item->code]);

        // Countries
        expect($item->country)
            ->code->toBe($nativeCountry[$item->code]->code)
            ->native->toBe($nativeCountry[$item->code]->native)
            ->localized->toBe($localizedCountry[$item->code]->localized);

        // Currencies
        expect($item->currency)
            ->code->toBe($nativeCurrency[$item->code]->code)
            ->numeric->toBe($nativeCurrency[$item->code]->numeric)
            ->native->toBe($nativeCurrency[$item->code]->native)
            ->localized->toBe($localizedCurrency[$item->code]->localized);
    }
})->with('locales');

it('checks locales without displaying currency information', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    // Locales
    /**
     * @var array<string, string> $nativeLocale
     */
    $nativeLocale = LocaleNames::get();
    $localizedLocale = LocaleNames::get($locale);

    // Country
    /**
     * @var array<string, CountryData> $nativeCountry
     */
    $nativeCountry = CountryNames::get()->all();
    $localizedCountry = CountryNames::get($locale)->all();

    foreach (Locales::available(true) as $item) {
        // Locales
        expect($item->native)->toBe($nativeLocale[$item->code]);
        expect($item->localized)->toBe($localizedLocale[$item->code]);

        // Countries
        expect($item->country)
            ->code->toBe($nativeCountry[$item->code]->code)
            ->native->toBe($nativeCountry[$item->code]->native)
            ->localized->toBe($localizedCountry[$item->code]->localized);

        // Currencies
        expect($item->currency)->toBeNull();
    }
})->with('locales');

it('checks locales without displaying country information', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    // Locales
    /**
     * @var array<string, string> $nativeLocale
     */
    $nativeLocale = LocaleNames::get();
    $localizedLocale = LocaleNames::get($locale);

    // Currency
    /**
     * @var array<string, CurrencyData> $nativeCurrency
     */
    $nativeCurrency = CurrencyNames::get()->all();
    $localizedCurrency = CurrencyNames::get($locale)->all();

    foreach (Locales::available(withCurrencies: true) as $item) {
        // Locales
        expect($item->native)->toBe($nativeLocale[$item->code]);
        expect($item->localized)->toBe($localizedLocale[$item->code]);

        // Countries
        expect($item->country)->toBeNull();

        // Currencies
        expect($item->currency)
            ->code->toBe($nativeCurrency[$item->code]->code)
            ->numeric->toBe($nativeCurrency[$item->code]->numeric)
            ->native->toBe($nativeCurrency[$item->code]->native)
            ->localized->toBe($localizedCurrency[$item->code]->localized);
    }
})->with('locales');

it('checks locales without displaying country and currency information', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    // Locales
    /**
     * @var array<string, string> $nativeLocale
     */
    $nativeLocale = LocaleNames::get();
    $localizedLocale = LocaleNames::get($locale);

    foreach (Locales::available() as $item) {
        expect($item->native)->toBe($nativeLocale[$item->code]);
        expect($item->localized)->toBe($localizedLocale[$item->code]);

        expect($item->country)->toBeNull();
        expect($item->currency)->toBeNull();
    }
})->with('locales');

it(
    'manually checks the localization of locales',
    function (
        string $locale,
        string $forLocale,
        string $native,
        string $localized,
        string $countryCode,
        string $countryNative,
        string $countryLocalized,
        string $currencyCode,
        int $currencyNumericCode,
        string $currencyNative,
        string $currencyLocalized,
    ) {
        setLocales($forLocale);

        expect(app()->getLocale())->toBe($forLocale);
        expect(Locales::getDefault()->code)->toBe($forLocale);

        expect(Locales::info($locale, true, true))
            // Locale
            ->code->toBe($locale)
            ->native->toBe($native)
            ->localized->toBe($localized)
            // Country
            ->country->code->toBe($countryCode)
            ->country->native->toBe($countryNative)
            ->country->localized->toBe($countryLocalized)
            // Currency
            ->currency->code->toBe($currencyCode)
            ->currency->numeric->toBe($currencyNumericCode)
            ->currency->native->toBe($currencyNative)
            ->currency->localized->toBe($currencyLocalized);
    }
)->with('localized');
