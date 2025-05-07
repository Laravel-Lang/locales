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

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;

it('checks the list of protected locales', function () {
    expect(Locales::raw()->protects())
        ->toBe([Locale::English->value]);
});

it('checks the list of protected locales when the primary locale changes', function () {
    setLocales(main: Locale::German);

    expect(Locales::raw()->protects())
        ->toBe([
            Locale::German->value,
            Locale::English->value,
        ]);
});

it('checks the list of protected locales when the fallback locale changes', function () {
    setLocales(fallback: Locale::German);

    expect(Locales::raw()->protects())
        ->toBe([
            Locale::German->value,
            Locale::English->value,
        ]);
});

it('checks the list of protected locales when all locales change', function () {
    setLocales(Locale::German, Locale::French);

    expect(Locales::raw()->protects())
        ->toBe([
            Locale::German->value,
            Locale::French->value,
        ]);
});

it('checks the protected locale by alias', function () {
    setLocales(Locale::German, Locale::French);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::raw()->protects())
        ->toBe([
            'de-DE',
            'fr-custom',
        ]);
});

it('checks for invalid primary locale', function () {
    setLocales(main: 'foo');

    expect(Locales::raw()->protects())
        ->toBe([Locale::English->value]);
});

it('checks for invalid fallback locale', function () {
    setLocales(fallback: 'foo');

    expect(Locales::raw()->protects())
        ->toBe([Locale::English->value]);
});

it('checks incorrect locale for signs of protecting', function () {
    setLocales('foo', 'bar');

    expect(Locales::raw()->protects())
        ->toBe([Locale::English->value]);
});
