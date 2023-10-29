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

use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Facades\Locales;

it('returns English locale as a fallback', function () {
    expect(Locales::getFallback())
        ->toBe(Locale::English->value);
});

it('returns German locale as a fallback', function () {
    setLocales(fallback: Locale::German);

    expect(Locales::getFallback())
        ->toBe(Locale::German->value);
});

it('returns English locale if the fallback one is specified incorrectly', function () {
    setLocales(fallback: 'foo');

    expect(Locales::getFallback())
        ->toBe(Locale::English->value);
});

it('returns German locale if the fallback is invalid', function () {
    setLocales(Locale::German, 'foo');

    expect(Locales::getFallback())
        ->toBe(Locale::German->value);
});

it('returns English locale if both are invalid', function () {
    setLocales('foo', 'foo');

    expect(Locales::getFallback())
        ->toBe(Locale::English->value);
});

it('will return the locale by alias', function (Locale $locale, string $alias) {
    setLocales(fallback: $locale);

    setAlias($locale, $alias);

    expect(Locales::getFallback())
        ->toBe($alias)
        ->not->toBe($locale->value);
})->with('aliased-locales');

it('will return the main localization if the spare is null', function () {
    setLocales(Locale::German, null);

    expect(Locales::getFallback())
        ->toBe(Locale::German->value)
        ->not->toBeNull();
});

it('will return the English locale if both are set to null', function () {
    setLocales(null, null);

    expect(Locales::getFallback())
        ->toBe(Locale::English->value)
        ->not->toBeNull();
});
