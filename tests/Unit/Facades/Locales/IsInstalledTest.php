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

it('checks whether localization is installed', function () {
    expect(Locales::isInstalled(Locale::English))->toBeBool()->toBeTrue();
    expect(Locales::isInstalled(Locale::German))->toBeBool()->toBeFalse();
});

it('checks the installation of protected locales', function () {
    setLocales(Locale::German, Locale::French);

    expect(Locales::isInstalled(Locale::German))->toBeBool()->toBeTrue();
    expect(Locales::isInstalled(Locale::French))->toBeBool()->toBeTrue();

    expect(Locales::isInstalled(Locale::English))->toBeBool()->toBeFalse();
    expect(Locales::isInstalled(Locale::Urdu))->toBeBool()->toBeFalse();
});

it('checks the label of installed locales using a json file', function () {
    File::store(lang_path('vendor/custom/de.json'), '{}');

    setAlias(Locale::German, 'de-DE');

    expect(Locales::isInstalled(Locale::German))->toBeBool()->toBeTrue();
    expect(Locales::isInstalled('de-DE'))->toBeBool()->toBeTrue();
});

it('checks the label of installed locales using a directory', function () {
    Directory::ensureDirectory(lang_path('vendor/custom/de'));

    setAlias(Locale::German, 'de-DE');

    expect(Locales::isInstalled(Locale::German))->toBeBool()->toBeTrue();
    expect(Locales::isInstalled('de-DE'))->toBeBool()->toBeTrue();
});
