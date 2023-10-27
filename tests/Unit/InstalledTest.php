<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2023 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;
use LaravelLang\Locales\Enums\Locales;

it('should return the default localizations', function () {
    expect(Locales::installed())
        ->toBe([
            Locales::English->value,
        ]);
});
it('should return the custom fallback localization', function () {
    setLocales(Locales::German);

    expect(Locales::installed())
        ->toBe([
            Locales::English->value,
            Locales::German->value,
        ]);
});

it('check the return of protected localizations', function () {
    setLocales('foo', 'foo');

    expect(Locales::installed())
        ->toBe([
            Locales::English->value,
        ]);
});

it('should return the custom protected localizations', function () {
    setLocales(Locales::German, Locales::French);

    expect(Locales::installed())
        ->toBe([
            Locales::French->value,
            Locales::German->value,
        ]);
});

it('will check the return of additional installed localizations', function () {
    createLocales(Locales::Russian, Locales::Ukrainian, Locales::French);

    setLocales(fallback: Locales::German);

    expect(Locales::installed())
        ->toBe([
            Locales::English->value,
            Locales::French->value,
            Locales::German->value,
            Locales::Russian->value,
            Locales::Ukrainian->value,
        ]);
});

it('check localization detection by file availability', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');

    expect(Locales::installed())
        ->toBe([
            Locales::English->value,
            Locales::German->value,
        ]);
});

it('check localization detection by directory availability', function () {
    Directory::ensureDirectory(lang_path('vendor/custom/de'));

    expect(Locales::installed())
        ->toBe([
            Locales::English->value,
            Locales::German->value,
        ]);
});
