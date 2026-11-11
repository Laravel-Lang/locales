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

namespace LaravelLang\Locales\Data;

use LaravelLang\Config\Services\AliasConfig;

class NativeData
{
    public function __construct(
        public readonly array $native,
        public readonly array $localized,
        protected readonly AliasConfig $alias,
    ) {}

    public function getNative(string $locale): mixed
    {
        return $this->get($this->native, $locale);
    }

    public function getLocalized(string $locale): mixed
    {
        return $this->get($this->localized, $locale);
    }

    protected function get(array $items, string $locale): mixed
    {
        $locale = $this->alias->from($locale);

        return $items[$locale];
    }
}
