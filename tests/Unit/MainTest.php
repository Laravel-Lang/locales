<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

use LaravelLang\Locales\Enums\Locales;

it('must be a correct locale')
    ->expect(Locales::getDefault())
    ->toBe(Locales::English->value);

it('must be a custom locale', function () {
    setLocales(main: Locales::German);

    expect(Locales::getDefault())
        ->toBe(Locales::German->value);
});

it('must be a invalid locale', function () {
    setLocales(main: 'foo');

    expect(Locales::getDefault())
        ->toBe(Locales::English->value);
});

it('should return English when both localizations are incorrect', function () {
    setLocales('foo', 'foo');

    expect(Locales::getDefault())
        ->toBe(Locales::English->value);
});
