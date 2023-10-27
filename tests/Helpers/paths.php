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

use DragonCode\Support\Facades\Filesystem\Directory;
use LaravelLang\Locales\Enums\Locales;

function createLocale(Locales|string $locale): void
{
    Directory::ensureDirectory(
        lang_path($locale->value ?? $locale)
    );
}

function createLocales(Locales|string ...$locales): void
{
    foreach ($locales as $locale) {
        createLocale($locale);
    }
}
