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

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;

it('returns English locale', function () {
    expect(Locales::getCurrent()->code)
        ->toBe(Locale::English->value);
});

it('returns German locale', function () {
    setLocales(main: Locale::German);

    expect(Locales::getCurrent()->code)
        ->toBe(Locale::German->value);
});

it('returns English locale if the main one is specified incorrectly', function () {
    setLocales(main: 'foo');

    expect(Locales::getCurrent()->code)
        ->toBe(Locale::English->value);
});

it('returns a backup locale if the main one is null', function () {
    setLocales(null, Locale::German);

    expect(Locales::getCurrent()->code)
        ->toBe(Locale::German->value);
});

it('returns English locale if primary and fallback are incorrect', function () {
    setLocales('foo', 'foo');

    expect(Locales::getCurrent()->code)
        ->toBe(Locale::English->value);
});

it('will return the locale by alias', function (Locale $locale, string $alias) {
    setLocales($locale);

    setAlias($locale, $alias);

    expect(Locales::getCurrent()->code)
        ->toBe($alias)
        ->not->toBe($locale->value);
})->with('aliased-locales');

it('will return the English locale if both are set to null', function () {
    setLocales(null, null);

    expect(Locales::getCurrent()->code)
        ->toBe(Locale::English->value);
});

it('checks for missing currency information')
    ->expect(fn () => Locales::getCurrent(withCurrency: false))
    ->country->not->toBeNull()
    ->currency->toBeNull();

it('checks for missing country information')
    ->expect(fn () => Locales::getCurrent(withCountry: false))
    ->country->toBeNull()
    ->currency->not->toBeNull();

it('checks for missing country and currency information')
    ->expect(fn () => Locales::getCurrent(false, false))
    ->country->toBeNull()
    ->currency->toBeNull();

it('returns the correct localized name if the non-default locale is set', function () {
    createLocales(Locale::German, Locale::English);

    Locales::set(Locale::English);

    expect(Locales::getCurrent())
        ->localized->toBeString()->toBe('English');

    Locales::set(Locale::German);

    expect(Locales::getCurrent())
        ->localized->toBeString()->toBe('Deutsch');
});
