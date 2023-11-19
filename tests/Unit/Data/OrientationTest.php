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
use LaravelLang\Locales\Enums\Orientation;
use LaravelLang\Locales\Facades\Locales;

it('checks the left-to-right orientation property', function (Locale $locale) {
    expect(Locales::info($locale))->orientation->toBe(Orientation::LeftToRight);
})->with('locale-orientation-left-to-right');

it('checks the right-to-left orientation property', function (Locale $locale) {
    expect(Locales::info($locale))->orientation->toBe(Orientation::RightToLeft);
})->with('locale-orientation-right-to-left');
