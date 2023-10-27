<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2023 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

use LaravelLang\Locales\Enums\Locales;

it('must be a correct fallback locale')
    ->expect(Locales::getFallback())
    ->toBe(Locales::English->value);

it('must be a custom fallback locale', function () {
    setLocales(fallback: Locales::German);

    expect(Locales::getFallback())
        ->toBe(Locales::German->value);
});

it('must be a invalid fallback locale', function () {
    setLocales(fallback: 'foo');

    expect(Locales::getFallback())
        ->toBe(Locales::English->value);
});

it('should return the main one when the spare one is invalid', function () {
    setLocales(Locales::German, 'foo');

    expect(Locales::getFallback())
        ->toBe(Locales::German->value);
});

it('should return English when both localizations are incorrect', function () {
    setLocales('foo', 'foo');

    expect(Locales::getFallback())
        ->toBe(Locales::English->value);
});
