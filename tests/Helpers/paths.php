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

use Illuminate\Support\Facades\File;
use LaravelLang\LocaleList\Locale;

function createLocale(Locale|string $locale): void
{
    File::ensureDirectoryExists(
        lang_path($locale->value ?? $locale)
    );
}

function createLocales(Locale|string ...$locales): void
{
    foreach ($locales as $locale) {
        createLocale($locale);
    }
}

function storeFile(string $path, string $content): void
{
    File::ensureDirectoryExists(dirname($path));

    File::put($path, $content);
}
