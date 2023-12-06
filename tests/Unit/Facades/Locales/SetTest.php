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

it('checks the main locale', function () {
    Locales::set(Locale::English);

    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});

it('checks fallback locale', function () {
    setLocales(null, Locale::German);

    Locales::set(Locale::German);

    expect(Locales::getDefault()->code)
        ->toBe(Locale::German->value);
});

it('checks for uninstalled locale', function () {
    Locales::set(Locale::French);

    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});

it('checks for invalid locale', function () {
    Locales::set('foo');

    expect(Locales::getDefault()->code)
        ->toBe(Locale::English->value);
});
