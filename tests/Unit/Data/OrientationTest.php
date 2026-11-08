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

use LaravelLang\LocaleList\Direction;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Facades\Locales;

it('checks the left-to-right direction property', function (Locale $locale) {
    expect(Locales::info($locale))->direction->toBe(Direction::LeftToRight);
})->with('locale-direction-left-to-right');

it('checks the right-to-left direction property', function (Locale $locale) {
    expect(Locales::info($locale))->direction->toBe(Direction::RightToLeft);
})->with('locale-direction-right-to-left');
