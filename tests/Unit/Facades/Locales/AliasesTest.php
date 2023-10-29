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

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;
use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Facades\Locales;

it('checks the use of aliases', function () {
    createLocales(Locale::German, Locale::GermanSwitzerland, Locale::SerbianCyrillic);
    setLocales(fallback: Locale::French);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::GermanSwitzerland, 'de-CH');

    expect(simpleData(Locales::installed()))->toBe([
        'de-CH',
        'de-DE',
        'en',
        'fr',
        'sr_Cyrl',
    ]);
});

it('checks aliases of installed locales in the vendor folder', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');
    File::store(lang_path('vendor/custom/de-DE.json'), '{}');

    Directory::ensureDirectory(lang_path('vendor/custom/de_CH'));
    Directory::ensureDirectory(lang_path('vendor/custom/de-CH'));

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::GermanSwitzerland, 'de-CH');

    expect(simpleData(Locales::installed()))->toBe([
        'de-CH',
        'de-DE',
        'en',
    ]);
});
