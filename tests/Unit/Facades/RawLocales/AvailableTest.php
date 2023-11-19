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

it('checks the list of available locales', function () {
    expect(Locales::raw()->available())
        ->toBeArray()
        ->toContain(
            Locale::English->value,
            Locale::German->value,
        )
        ->not->toContain('foo', 'bar');
});

it('checks the list of available locales taking into account aliases', function (Locale $locale, string $alias) {
    setAlias($locale, $alias);

    expect(Locales::raw()->available())
        ->toBeArray()
        ->toContain($alias)
        ->not->toContain($locale->value);
})->with('aliased-locales');

it('checks incorrect locales against the list of available ones', function (?string $locale) {
    expect(Locales::raw()->available())->toBeArray()->not->toContain($locale);
})->with('incorrect-locales');
