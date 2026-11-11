<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2025 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;

it('resolves info for every locale of the locale list', function (Locale $locale) {
    expect(Locales::info($locale))
        ->code->toBe($locale->value)
        ->type->toBeString()
        ->regional->toBeString();
})->with(Locale::cases());
