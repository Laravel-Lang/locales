<?php

/**
 * This file is part of the "laravel-Lang/locales" project.
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

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;
use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Facades\Locales;

it('returns English locale as the only one installed', function () {
    expect(Locales::installed())
        ->toBe([Locale::English->value])
        ->not->toBeIn([Locale::Thai->value, Locale::Turkish->value]);
});

it('returns English and German locales as the only ones installed', function () {
    setLocales(Locale::German);

    expect(Locales::installed())
        ->toBe([
            Locale::English->value,
            Locale::German->value,
        ])
        ->not->toBeIn([
            Locale::Thai->value,
            Locale::Turkish->value,
        ]);
});

it('returns English locale if both are specified incorrectly', function () {
    setLocales('foo', 'foo');

    expect(Locales::installed())
        ->toBe([Locale::English->value])
        ->not->toBeIn([Locale::Thai->value, Locale::Turkish->value]);
});

it('returns German and French locales as the only ones installed', function () {
    setLocales(Locale::German, Locale::French);

    expect(Locales::installed())
        ->toBe([
            Locale::French->value,
            Locale::German->value,
        ]);
});

it('returns a list of installed locales', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(fallback: Locale::German);

    expect(Locales::installed())
        ->toBe([
            Locale::English->value,
            Locale::French->value,
            Locale::German->value,
            Locale::Russian->value,
            Locale::Ukrainian->value,
        ])
        ->not->toBeIn([
            Locale::Thai->value,
            Locale::Turkish->value,
        ]);
});

it('check localization detection by vendor file availability', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');

    expect(Locales::installed())
        ->toBe([
            Locale::English->value,
            Locale::German->value,
        ]);
});

it('check localization detection by vendor directory availability', function () {
    Directory::ensureDirectory(lang_path('vendor/custom/de'));

    expect(Locales::installed())
        ->toBe([
            Locale::English->value,
            Locale::German->value,
        ]);
});
