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

use LaravelLang\Locales\Enums\Locale as LocaleCode;
use LaravelLang\Locales\Helpers\Config;

trait Aliases
{
    protected array $aliases = [];

    protected function fromAlias(LocaleCode|string|null $locale, Config $config): ?string
    {
        if ($locale = $locale?->value ?? $locale) {
            if ($hashed = $this->aliases[$locale] ?? false) {
                return $hashed;
            }

            return $this->aliases[$locale] = $this->arr->of($config->getAliases())->flip()->get($locale);
        }

        return null;
    }

    protected function toAlias(LocaleCode|string|null $locale, Config $config): ?string
    {
        if ($locale = $locale?->value ?? $locale) {
            if ($hashed = $this->aliases[$locale] ?? false) {
                return $hashed;
            }

            return $this->aliases[$locale] = $this->arr->get($config->getAliases(), $locale, $locale);
        }

        return null;
    }
}
