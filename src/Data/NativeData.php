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

use LaravelLang\Config\Services\AliasLangConfig;

class NativeData
{
    public function __construct(
        public readonly array $native,
        public readonly array $localized,
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
        $locale = $this->config()->from($locale);

        return $items[$locale];
    }

    protected function config(): AliasLangConfig
    {
        return app(AliasLangConfig::class);
    }
}
