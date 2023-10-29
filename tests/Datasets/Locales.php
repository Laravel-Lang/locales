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

use LaravelLang\Locales\Enums\Locale;

dataset('locales', Locale::values());

dataset('incorrect-locales', ['FOO', 'BAR', 'AA', 'BB', 'cc', 'dd', null]);

dataset('aliased-locales', [
    Locale::German->value => [Locale::German, 'de-DE'],
    Locale::French->value => [Locale::French, 'fr-custom'],
]);
