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

use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Facades\Locales;
use LaravelLang\NativeLocaleNames\Native;

it('checks language localization', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    $native    = Native::get();
    $english   = Native::get(Locale::English);
    $localized = Native::get($locale);

    foreach (Locales::available() as $item) {
        expect($item->name)->toBe($english[$item->code]);
        expect($item->native)->toBe($native[$item->code]);
        expect($item->localized)->toBe($localized[$item->code]);
    }
})->with('locales');

it(
    'manually checks the localization of locales',
    function (string $locale, string $forLocale, string $name, string $native, string $localized) {
        setLocales($forLocale);

        expect(app()->getLocale())->toBe($forLocale);
        expect(Locales::getDefault()->code)->toBe($forLocale);

        expect(Locales::info($locale))
            ->code->toBe($locale)
            ->name->toBe($name)
            ->native->toBe($native)
            ->localized->toBe($localized);
    }
)->with('localized');
