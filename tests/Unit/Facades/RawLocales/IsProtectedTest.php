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

use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Facades\Locales;

it('checks whether the locale is protected', function () {
    expect(Locales::raw()->isProtected(Locale::English))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected(Locale::German))->toBeBool()->toBeFalse();
});

it('checks if the locale is protected when the main locale changes', function () {
    setLocales(main: Locale::German);

    expect(Locales::raw()->isProtected(Locale::German))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected(Locale::English))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected(Locale::French))->toBeBool()->toBeFalse();
});

it('checks if the locale is protected when the fallback locale is changed', function () {
    setLocales(fallback: Locale::French);

    expect(Locales::raw()->isProtected(Locale::German))->toBeBool()->toBeFalse();
    expect(Locales::raw()->isProtected(Locale::English))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected(Locale::French))->toBeBool()->toBeTrue();
});

it('checks if the locale is protected when all locales change', function () {
    setLocales(Locale::German, Locale::French);

    expect(Locales::raw()->isProtected(Locale::German))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected(Locale::English))->toBeBool()->toBeFalse();
    expect(Locales::raw()->isProtected(Locale::French))->toBeBool()->toBeTrue();
});

it('checks if the locale is protected when checking for invalid values', function () {
    setLocales('foo', 'bar');

    expect(Locales::raw()->isProtected(Locale::English))->toBeBool()->toBeTrue();

    expect(Locales::raw()->isProtected('foo'))->toBeBool()->toBeFalse();
    expect(Locales::raw()->isProtected('bar'))->toBeBool()->toBeFalse();
});

it('checks the protected locale by alias', function () {
    setLocales(Locale::German, Locale::French);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::raw()->isProtected(Locale::German))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected(Locale::French))->toBeBool()->toBeTrue();

    expect(Locales::raw()->isProtected('de-DE'))->toBeBool()->toBeTrue();
    expect(Locales::raw()->isProtected('fr-custom'))->toBeBool()->toBeTrue();

    expect(Locales::raw()->isProtected(Locale::English))->toBeBool()->toBeFalse();
});
