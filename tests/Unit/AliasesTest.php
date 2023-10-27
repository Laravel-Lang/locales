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
