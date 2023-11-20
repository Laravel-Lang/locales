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

it('returns the base locale from the correctly passed one', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales(Locale::French, Locale::German);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::raw()->get('de'))->toBe('de-DE');
    expect(Locales::raw()->get('de-DE'))->toBe('de-DE');

    expect(Locales::raw()->get('fr'))->toBe('fr-custom');
    expect(Locales::raw()->get('fr-custom'))->toBe('fr-custom');

    expect(Locales::raw()->get('ru'))->toBe('ru');
    expect(Locales::raw()->get('uk'))->toBe('uk');

    expect(Locales::raw()->get(Locale::German))->toBe('de-DE');
    expect(Locales::raw()->get(Locale::French))->toBe('fr-custom');
    expect(Locales::raw()->get(Locale::Russian))->toBe('ru');
    expect(Locales::raw()->get(Locale::Ukrainian))->toBe('uk');
});

it('returns the main locale if passed incorrectly or empty', function () {
    setLocales(Locale::French, Locale::German);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::raw()->get('foo'))->toBe('fr-custom');
    expect(Locales::raw()->get('bar'))->toBe('fr-custom');

    expect(Locales::raw()->get(''))->toBe('fr-custom');
    expect(Locales::raw()->get(null))->toBe('fr-custom');

    expect(Locales::raw()->get('100'))->toBe('fr-custom');
    expect(Locales::raw()->get(100))->toBe('fr-custom');

    expect(Locales::raw()->get('{}'))->toBe('fr-custom');
    expect(Locales::raw()->get('[]'))->toBe('fr-custom');
    expect(Locales::raw()->get([]))->toBe('fr-custom');

    expect(Locales::raw()->get(new stdClass()))->toBe('fr-custom');
});

it('returns the main locale if passed unset', function () {
    setLocales(Locale::French, Locale::German);

    setAlias(Locale::German, 'de-DE');
    setAlias(Locale::French, 'fr-custom');

    expect(Locales::raw()->get(Locale::Swedish))->toBe('fr-custom');
    expect(Locales::raw()->get('sv'))->toBe('fr-custom');
});

it('returns a fallback locale from a correctly passed one', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales(null, Locale::German);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::raw()->get('de'))->toBe('de-DE');
    expect(Locales::raw()->get('de-DE'))->toBe('de-DE');

    expect(Locales::raw()->get('ru'))->toBe('ru');
    expect(Locales::raw()->get('uk'))->toBe('uk');

    expect(Locales::raw()->get(Locale::German))->toBe('de-DE');
    expect(Locales::raw()->get(Locale::French))->toBe('de-DE');
    expect(Locales::raw()->get(Locale::Russian))->toBe('ru');
    expect(Locales::raw()->get(Locale::Ukrainian))->toBe('uk');
});

it('returns a fallback locale if an incorrect or empty locale is passed', function () {
    setLocales(null, Locale::German);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::raw()->get('foo'))->toBe('de-DE');
    expect(Locales::raw()->get('bar'))->toBe('de-DE');

    expect(Locales::raw()->get(''))->toBe('de-DE');
    expect(Locales::raw()->get(null))->toBe('de-DE');

    expect(Locales::raw()->get('100'))->toBe('de-DE');
    expect(Locales::raw()->get(100))->toBe('de-DE');

    expect(Locales::raw()->get('{}'))->toBe('de-DE');
    expect(Locales::raw()->get('[]'))->toBe('de-DE');
    expect(Locales::raw()->get([]))->toBe('de-DE');

    expect(Locales::raw()->get(new stdClass()))->toBe('de-DE');
});

it('returns a fallback locale if passed an uninstalled one', function () {
    setLocales(null, Locale::German);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::raw()->get(Locale::Swedish))->toBe('de-DE');
    expect(Locales::raw()->get('sv'))->toBe('de-DE');
});

it('returns the primary locale from the correctly passed one if a fallback is not installed', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales(Locale::German, null);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::raw()->get('de'))->toBe('de-DE');
    expect(Locales::raw()->get('de-DE'))->toBe('de-DE');

    expect(Locales::raw()->get('ru'))->toBe('ru');
    expect(Locales::raw()->get('uk'))->toBe('uk');

    expect(Locales::raw()->get(Locale::German))->toBe('de-DE');
    expect(Locales::raw()->get(Locale::French))->toBe('de-DE');
    expect(Locales::raw()->get(Locale::Russian))->toBe('ru');
    expect(Locales::raw()->get(Locale::Ukrainian))->toBe('uk');
});

it(
    'returns a fallback locale if an invalid or empty locale is passed and if the fallback is not installed',
    function () {
        setLocales(Locale::German, null);

        setAlias(Locale::German, 'de-DE');

        expect(Locales::raw()->get('foo'))->toBe('de-DE');
        expect(Locales::raw()->get('bar'))->toBe('de-DE');

        expect(Locales::raw()->get(''))->toBe('de-DE');
        expect(Locales::raw()->get(null))->toBe('de-DE');

        expect(Locales::raw()->get('100'))->toBe('de-DE');
        expect(Locales::raw()->get(100))->toBe('de-DE');

        expect(Locales::raw()->get(new stdClass()))->toBe('de-DE');
    }
);

it('returns a fallback locale if passed unset and if the fallback is not installed', function () {
    setLocales(Locale::German, null);

    setAlias(Locale::German, 'de-DE');

    expect(Locales::raw()->get(Locale::Swedish))->toBe('de-DE');
    expect(Locales::raw()->get('sv'))->toBe('de-DE');
});

it('returns default locale if primary and fallback are invalid', function () {
    createLocales(Locale::Russian, Locale::Ukrainian);

    setLocales('foo', null);

    expect(Locales::raw()->get('de'))->toBe('en');
    expect(Locales::raw()->get('de-DE'))->toBe('en');

    expect(Locales::raw()->get('ru'))->toBe('ru');
    expect(Locales::raw()->get('uk'))->toBe('uk');

    expect(Locales::raw()->get(Locale::German))->toBe('en');
    expect(Locales::raw()->get(Locale::French))->toBe('en');
    expect(Locales::raw()->get(Locale::Russian))->toBe('ru');
    expect(Locales::raw()->get(Locale::Ukrainian))->toBe('uk');
});

it(
    'returns the default locale if an incorrect or empty locale is passed and if the primary and fallback locales are incorrect',
    function () {
        setLocales('foo', null);

        expect(Locales::raw()->get('foo'))->toBe('en');
        expect(Locales::raw()->get('bar'))->toBe('en');

        expect(Locales::raw()->get(''))->toBe('en');
        expect(Locales::raw()->get(null))->toBe('en');

        expect(Locales::raw()->get('100'))->toBe('en');
        expect(Locales::raw()->get(100))->toBe('en');

        expect(Locales::raw()->get('{}'))->toBe('en');
        expect(Locales::raw()->get('[]'))->toBe('en');
        expect(Locales::raw()->get([]))->toBe('en');

        expect(Locales::raw()->get(new stdClass()))->toBe('en');
    }
);

it('returns the default locale if passed is not set and if the main and fallback are incorrect', function () {
    setLocales('foo', null);

    expect(Locales::raw()->get(Locale::Swedish))->toBe('en');
    expect(Locales::raw()->get('sv'))->toBe('en');
});
