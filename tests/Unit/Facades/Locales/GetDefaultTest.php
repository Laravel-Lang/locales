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

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;

it('returns English locale', function () {
    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});

it('returns German locale', function () {
    setLocales(main: Locale::German);

    expect(Locales::getDefault()->code)
        ->toBe(Locale::German->value);
});

it('returns English locale if the main one is specified incorrectly', function () {
    setLocales(main: 'foo');

    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});

it('returns a backup locale if the main one is null', function () {
    setLocales(null, Locale::German);

    expect(Locales::getDefault()->code)
        ->toBe(Locale::German->value);
});

it('returns English locale if primary and fallback are incorrect', function () {
    setLocales('foo', 'foo');

    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});

it('will return the locale by alias', function (Locale $locale, string $alias) {
    setLocales($locale);

    setAlias($locale, $alias);

    expect(Locales::getDefault()->code)
        ->toBe($alias)
        ->not->toBe($locale->value);
})->with('aliased-locales');

it('will return the English locale if both are set to null', function () {
    setLocales(null, null);

    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});
