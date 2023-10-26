<?php

/**
 * This file is part of the "Laravel-Lang/Locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2022 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/Locales
 */

declare(strict_types=1);

namespace LaravelLang\Locales\Exceptions;

use DragonCode\Support\Facades\Helpers\Arr;
use LaravelLang\Locales\Enums\Locales;
use RuntimeException;

class BaseException extends RuntimeException
{
    protected function stringify(array|Locales|string $locales): string
    {
        $locales = is_array($locales) ? $locales : [$locales];

        return Arr::of($locales)
            ->map(static fn (Locales|string $locale) => $locale?->value ?? $locale)
            ->implode(', ')
            ->toString();
    }
}
