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

namespace LaravelLang\Locales\Exceptions;

use DragonCode\Support\Facades\Helpers\Arr;
use LaravelLang\Locales\Enums\Locale;
use RuntimeException;

class BaseException extends RuntimeException
{
    protected function stringify(array|Locale|string $locales): string
    {
        $locales = is_array($locales) ? $locales : [$locales];

        return Arr::of($locales)
            ->map(static fn (Locale|string $locale) => $locale?->value ?? $locale)
            ->implode(', ')
            ->toString();
    }
}
