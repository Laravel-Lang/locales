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

use LaravelLang\Locales\Facades\Locales;
use LaravelLang\NativeLocaleNames\Native;

it('checks language localization', function (string $locale) {
    app()->setLocale($locale);

    expect(app()->getLocale())->toBe($locale);

    $combined  = Native::get();
    $localized = Native::get($locale);

    foreach (Locales::available() as $item) {
        expect($item->native)->toBe($combined[$item->code]);
        expect($item->localized)->toBe($localized[$item->code]);
    }
})->with('locales');
