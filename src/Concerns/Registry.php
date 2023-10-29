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

namespace LaravelLang\Locales\Concerns;

use Closure;
use DragonCode\Support\Facades\Helpers\Arr;
use LaravelLang\Locales\Enums\Locale;

trait Registry
{
    protected array $registry = [];

    protected function registry(array|Locale|string|null $key, Closure $callback): mixed
    {
        $key = $this->registryKey($key);

        if (array_key_exists($key, $this->registry)) {
            return $this->registry[$key];
        }

        return $this->registry[$key] = $callback();
    }

    protected function registryKey(array|Locale|string|null $key): string
    {
        return Arr::of(Arr::wrap($key))
            ->map(static fn (mixed $item) => $item instanceof Locale ? $item->value : (string) $key)
            ->implode(':')->toString();
    }
}
