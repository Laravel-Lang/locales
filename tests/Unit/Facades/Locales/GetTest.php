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
use Pest\Expectation;

it('returns the base locale from the correctly passed one', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales(Locale::French, Locale::German);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::get('de')->code)->toBe('de-DE');
    expect(Locales::get('de-DE')->code)->toBe('de-DE');

    expect(Locales::get('fr')->code)->toBe('fr-custom');
    expect(Locales::get('fr-custom')->code)->toBe('fr-custom');

    expect(Locales::get('ru')->code)->toBe('ru');
    expect(Locales::get('uk')->code)->toBe('uk');

    expect(Locales::get(Locale::German)->code)->toBe('de-DE');
    expect(Locales::get(Locale::French)->code)->toBe('fr-custom');
    expect(Locales::get(Locale::Russian)->code)->toBe('ru');
    expect(Locales::get(Locale::Ukrainian)->code)->toBe('uk');
});

it('returns the main locale if passed incorrectly or empty', function () {
    setLocales(Locale::French, Locale::German);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::get('foo')->code)->toBe('fr-custom');
    expect(Locales::get('bar')->code)->toBe('fr-custom');

    expect(Locales::get('')->code)->toBe('fr-custom');
    expect(Locales::get(null)->code)->toBe('fr-custom');

    expect(Locales::get('100')->code)->toBe('fr-custom');
    expect(Locales::get(100)->code)->toBe('fr-custom');

    expect(Locales::get('{}')->code)->toBe('fr-custom');
    expect(Locales::get('[]')->code)->toBe('fr-custom');
    expect(Locales::get([])->code)->toBe('fr-custom');

    expect(Locales::get(new stdClass())->code)->toBe('fr-custom');
});

it('returns the main locale if passed unset', function () {
    setLocales(Locale::French, Locale::German);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::get(Locale::Swedish)->code)->toBe('fr-custom');
    expect(Locales::get('sv')->code)->toBe('fr-custom');
});

it('returns a fallback locale from a correctly passed one', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales(null, Locale::German);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::get('de')->code)->toBe('de-DE');
    expect(Locales::get('de-DE')->code)->toBe('de-DE');

    expect(Locales::get('ru')->code)->toBe('ru');
    expect(Locales::get('uk')->code)->toBe('uk');

    expect(Locales::get(Locale::German)->code)->toBe('de-DE');
    expect(Locales::get(Locale::French)->code)->toBe('de-DE');
    expect(Locales::get(Locale::Russian)->code)->toBe('ru');
    expect(Locales::get(Locale::Ukrainian)->code)->toBe('uk');
});

it('returns a fallback locale if an incorrect or empty locale is passed', function () {
    setLocales(null, Locale::German);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::get('foo')->code)->toBe('de-DE');
    expect(Locales::get('bar')->code)->toBe('de-DE');

    expect(Locales::get('')->code)->toBe('de-DE');
    expect(Locales::get(null)->code)->toBe('de-DE');

    expect(Locales::get('100')->code)->toBe('de-DE');
    expect(Locales::get(100)->code)->toBe('de-DE');

    expect(Locales::get('{}')->code)->toBe('de-DE');
    expect(Locales::get('[]')->code)->toBe('de-DE');
    expect(Locales::get([])->code)->toBe('de-DE');

    expect(Locales::get(new stdClass())->code)->toBe('de-DE');
});

it('returns a fallback locale if passed an uninstalled one', function () {
    setLocales(null, Locale::German);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::get(Locale::Swedish)->code)->toBe('de-DE');
    expect(Locales::get('sv')->code)->toBe('de-DE');
});

it('returns the primary locale from the correctly passed one if a fallback is not installed', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales(Locale::German, null);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::get('de')->code)->toBe('de-DE');
    expect(Locales::get('de-DE')->code)->toBe('de-DE');

    expect(Locales::get('ru')->code)->toBe('ru');
    expect(Locales::get('uk')->code)->toBe('uk');

    expect(Locales::get(Locale::German)->code)->toBe('de-DE');
    expect(Locales::get(Locale::French)->code)->toBe('de-DE');
    expect(Locales::get(Locale::Russian)->code)->toBe('ru');
    expect(Locales::get(Locale::Ukrainian)->code)->toBe('uk');
});

it(
    'returns a fallback locale if an invalid or empty locale is passed and if the fallback is not installed',
    function () {
        setLocales(Locale::German, null);

        setAlias(Locale::German, 'de-DE');

        expect(Locales::get('foo')->code)->toBe('de-DE');
        expect(Locales::get('bar')->code)->toBe('de-DE');

        expect(Locales::get('')->code)->toBe('de-DE');
        expect(Locales::get(null)->code)->toBe('de-DE');

        expect(Locales::get('100')->code)->toBe('de-DE');
        expect(Locales::get(100)->code)->toBe('de-DE');

        expect(Locales::get(new stdClass())->code)->toBe('de-DE');
    }
);

it('returns a fallback locale if passed unset and if the fallback is not installed', function () {
    setLocales(Locale::German, null);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::get(Locale::Swedish)->code)->toBe('de-DE');
    expect(Locales::get('sv')->code)->toBe('de-DE');
});

it('returns default locale if primary and fallback are invalid', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales('foo', null);

    expect(Locales::get('de')->code)->toBe('en');
    expect(Locales::get('de-DE')->code)->toBe('en');

    expect(Locales::get('ru')->code)->toBe('ru');
    expect(Locales::get('uk')->code)->toBe('uk');

    expect(Locales::get(Locale::German)->code)->toBe('en');
    expect(Locales::get(Locale::French)->code)->toBe('en');
    expect(Locales::get(Locale::Russian)->code)->toBe('ru');
    expect(Locales::get(Locale::Ukrainian)->code)->toBe('uk');
});

it(
    'returns the default locale if an incorrect or empty locale is passed and if the primary and fallback locales are incorrect',
    function () {
        setLocales('foo', null);

        expect(Locales::get('foo')->code)->toBe('en');
        expect(Locales::get('bar')->code)->toBe('en');

        expect(Locales::get('')->code)->toBe('en');
        expect(Locales::get(null)->code)->toBe('en');

        expect(Locales::get('100')->code)->toBe('en');
        expect(Locales::get(100)->code)->toBe('en');

        expect(Locales::get('{}')->code)->toBe('en');
        expect(Locales::get('[]')->code)->toBe('en');
        expect(Locales::get([])->code)->toBe('en');

        expect(Locales::get(new stdClass())->code)->toBe('en');
    }
);

it('returns the default locale if passed is not set and if the main and fallback are incorrect', function () {
    setLocales('foo', null);

    expect(Locales::get(Locale::Swedish)->code)->toBe('en');
    expect(Locales::get('sv')->code)->toBe('en');
});

it('checks the return of the main localization if uninstalled ones are transmitted', function (string $locale) {
    setLocales(Locale::German, Locale::French);

    $german = Locale::German->value;
    $french = Locale::French->value;

    expect(Locales::get($locale)->code)
        ->when($locale === $german, fn (Expectation $item) => $item->toBe($german))
        ->when($locale === $french, fn (Expectation $item) => $item->toBe($french))
        ->when(! in_array($locale, [$german, $french], true), fn (Expectation $item) => $item->toBe($german));
})->with('locales');

it('checks the return of the fallback localization if uninstalled ones are transmitted', function (string $locale) {
    setLocales(null, Locale::French);

    expect(Locales::get($locale)->code)->toBe(Locale::French->value);
})->with('locales');
