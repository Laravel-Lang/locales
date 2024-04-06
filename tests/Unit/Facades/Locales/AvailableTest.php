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
use LaravelLang\Locales\Data\LocaleData;
use LaravelLang\Locales\Facades\Locales;
use Pest\Expectation;

it('checks the list of available locales', function () {
    expect(simpleData(Locales::available()))
        ->toBeArray()
        ->toContain(
            Locale::English->value,
            Locale::German->value,
        )
        ->not->toContain('foo', 'bar');
});

it('checks the list of available locales taking into account aliases', function (Locale $locale, string $alias) {
    setAlias($locale, $alias);

    expect(simpleData(Locales::available()))
        ->toBeArray()
        ->toContain($alias)
        ->not->toContain($locale->value);
})->with('aliased-locales');

it('checks incorrect locales against the list of available ones', function (?string $locale) {
    expect(simpleData(Locales::available()))->toBeArray()->not->toContain($locale);
})->with('incorrect-locales');

it('checks for missing currency information')
    ->expect(fn () => Locales::available(true))
    ->each(fn (Expectation|LocaleData $item) => $item
        ->country->not->toBeNull()
        ->currency->toBeNull()
    );

it('checks for missing country information')
    ->expect(fn () => Locales::available(withCurrencies: true))
    ->each(fn (Expectation|LocaleData $item) => $item
        ->country->toBeNull()
        ->currency->not->toBeNull()
    );

it('checks for missing country and currency information')
    ->expect(fn () => Locales::available())
    ->each(fn (Expectation|LocaleData $item) => $item
        ->country->toBeNull()
        ->currency->toBeNull()
    );
