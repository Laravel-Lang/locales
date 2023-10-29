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

it('checks availability of all locales', function (Locale $locale) {
    expect(Locales::isAvailable($locale))->toBeBool()->toBeTrue();
})->with('locales');

it('should check the availability of the locale by alias', function (Locale $locale, string $alias) {
    setAlias($locale, $alias);

    expect(Locales::isAvailable($locale))->toBeBool()->toBeTrue();
    expect(Locales::isAvailable($locale->value))->toBeBool()->toBeTrue();
    expect(Locales::isAvailable($alias))->toBeBool()->toBeTrue();
})->with('aliased-locales');

it('checks incorrect locales', function (?string $locale) {
    expect(Locales::isAvailable($locale))->toBeBool()->toBeFalse();
})->with('incorrect-locales');
