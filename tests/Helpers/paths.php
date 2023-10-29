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

use DragonCode\Support\Facades\Filesystem\Directory;
use LaravelLang\Locales\Enums\Locale;

function createLocale(Locale|string $locale): void
{
    Directory::ensureDirectory(
        lang_path($locale->value ?? $locale)
    );
}

function createLocales(Locale|string ...$locales): void
{
    foreach ($locales as $locale) {
        createLocale($locale);
    }
}
