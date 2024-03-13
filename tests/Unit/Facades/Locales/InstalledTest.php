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

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Data\LocaleData;
use LaravelLang\Locales\Facades\Locales;
use Pest\Expectation;

it('returns English locale as the only one installed', function () {
    expect(simpleData(Locales::installed()))
        ->toBe([Locale::English->value]);
});

it('returns English and German locales as the only ones installed', function () {
    setLocales(Locale::German);

    expect(simpleData(Locales::installed()))
        ->toBe([
            Locale::German->value,
            Locale::English->value,
        ])
        ->not->toContain([
            Locale::Thai->value,
            Locale::Turkish->value,
        ]);
});

it('returns English locale if both are specified incorrectly', function () {
    setLocales('foo', 'foo');

    expect(simpleData(Locales::installed()))
        ->toBe([Locale::English->value]);
});

it('returns German and French locales as the only ones installed', function () {
    setLocales(Locale::German, Locale::French);

    expect(simpleData(Locales::installed()))
        ->toBe([
            Locale::German->value,
            Locale::French->value,
        ]);
});

it('returns a list of installed locales', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(fallback: Locale::German);

    expect(simpleData(Locales::installed()))
        ->toBe([
            Locale::German->value,
            Locale::English->value,
            Locale::French->value,
            Locale::Russian->value,
            Locale::Ukrainian->value,
        ]);
});

it('check localization detection by vendor file availability', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');

    expect(simpleData(Locales::installed()))
        ->toBe([
            Locale::German->value,
            Locale::English->value,
        ]);
});

it('check localization detection by vendor directory availability', function () {
    Directory::ensureDirectory(lang_path('vendor/custom/de'));

    expect(simpleData(Locales::installed()))
        ->toBe([
            Locale::German->value,
            Locale::English->value,
        ]);
});

it('checks installed localizations without declaring aliases', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');
    File::store(lang_path('vendor/custom/de-DE.json'), '{}');

    Directory::ensureDirectory(lang_path('vendor/custom/de_CH'));
    Directory::ensureDirectory(lang_path('vendor/custom/de-CH'));

    expect(simpleData(Locales::installed()))->toBe([
        'de',
        'de_CH',
        'en',
    ]);
});

it('will display a list of installed localizations without protected ones', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(Locale::German, Locale::French);

    expect(simpleData(Locales::installed(false)))
        ->toBe([
            Locale::Russian->value,
            Locale::Ukrainian->value,
        ]);
});

it('checks for missing currency information', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(Locale::German, Locale::French);

    expect(Locales::installed(withCurrencies: false))
        ->each(fn (Expectation|LocaleData $item) => $item
            ->country->not->toBeNull()
            ->currency->toBeNull()
        );
});

it('checks for missing country information', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(Locale::German, Locale::French);

    expect(Locales::installed(withCountries: false))
        ->each(fn (Expectation|LocaleData $item) => $item
            ->country->toBeNull()
            ->currency->not->toBeNull()
        );
});

it('checks for missing country and currency information', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(Locale::German, Locale::French);

    expect(Locales::installed(withCountries: false, withCurrencies: false))
        ->each(fn (Expectation|LocaleData $item) => $item
            ->country->toBeNull()
            ->currency->toBeNull()
        );
});
