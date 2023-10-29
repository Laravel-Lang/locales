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

it('checks whether protected locales are installed', function () {
    expect(Locales::notInstalled())
        ->toBeArray()
        ->toContain(Locale::German->value)
        ->not->toContain(Locale::English->value);
});

it('checks whether the main locale is installed', function () {
    setLocales(main: Locale::German);

    expect(Locales::notInstalled())
        ->toContain(Locale::French->value)
        ->not->toContain(Locale::German->value, Locale::English->value);
});

it('checks whether a fallback locale is installed', function () {
    setLocales(fallback: Locale::German);

    expect(Locales::notInstalled())
        ->toContain(Locale::French->value)
        ->not->toContain(Locale::German->value, Locale::English->value);
});

it('checks the availability of installed localizations', function () {
    createLocales(Locale::Russian, Locale::Ukrainian, Locale::French);

    setLocales(fallback: Locale::German);

    expect(Locales::notInstalled())
        ->toContain(Locale::Urdu->value)
        ->not->toContain(
            Locale::English->value,
            Locale::French->value,
            Locale::German->value,
            Locale::Russian->value,
            Locale::Ukrainian->value,
        );
});

it('check localization detection by file availability', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');

    expect(Locales::notInstalled())
        ->toContain(Locale::French->value)
        ->not->toContain(
            Locale::English->value,
            Locale::German->value,
        );
});

it('check localization detection by directory availability', function () {
    Directory::ensureDirectory(lang_path('vendor/custom/de'));

    expect(Locales::notInstalled())
        ->toContain(Locale::French->value)
        ->not->toContain(
            Locale::English->value,
            Locale::German->value,
        );
});
