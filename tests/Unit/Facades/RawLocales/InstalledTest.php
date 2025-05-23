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

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;

it('returns English locale as the only one installed', function () {
    expect(Locales::raw()->installed())
        ->toBe([Locale::English->value]);
});

it('returns English and German locales as the only ones installed', function () {
    setLocales(Locale::German);

    expect(Locales::raw()->installed())
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

    expect(Locales::raw()->installed())
        ->toBe([Locale::English->value]);
});

it('returns German and French locales as the only ones installed', function () {
    setLocales(Locale::German, Locale::French);

    expect(Locales::raw()->installed())
        ->toBe([
            Locale::German->value,
            Locale::French->value,
        ]);
});

it('returns a list of installed locales', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(fallback: Locale::German);

    expect(Locales::raw()->installed())
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

    expect(Locales::raw()->installed())
        ->toBe([
            Locale::German->value,
            Locale::English->value,
        ]);
});

it('check localization detection by vendor directory availability', function () {
    Directory::ensureDirectory(lang_path('vendor/custom/de'));

    expect(Locales::raw()->installed())
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

    expect(Locales::raw()->installed())->toBe([
        'de',
        'de_CH',
        'en',
    ]);
});

it('will display a list of installed localizations without protected ones', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(Locale::German, Locale::French);

    expect(Locales::raw()->installed(false))
        ->toBe([
            Locale::Russian->value,
            Locale::Ukrainian->value,
        ]);
});
