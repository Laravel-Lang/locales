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

use LaravelLang\Locales\Enums\Locales;

it('checks the use of aliases', function () {
    createLocales(Locales::German, Locales::GermanSwitzerland, Locales::SerbianCyrillic);
    setLocales(fallback: Locales::French);

    setAlias(Locales::German, 'de-DE');
    setAlias(Locales::GermanSwitzerland, 'de-CH');

    expect(Locales::installed())->toBe([
        'de-CH',
        'de-DE',
        'en',
        'fr',
        'sr_Cyrl',
    ]);
});
