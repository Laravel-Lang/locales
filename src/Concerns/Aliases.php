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

namespace LaravelLang\Locales\Concerns;

use Illuminate\Support\Collection;
use LaravelLang\Config\Data\ConfigData;
use LaravelLang\LocaleList\Locale as LocaleCode;
use LaravelLang\Locales\Data\LocaleData;

trait Aliases
{
    protected function fromAlias(LocaleCode|LocaleData|string|null $locale): ?string
    {
        if ($locale = $this->stringify($locale)) {
            return $this->aliases()->flip()->get($locale, $locale);
        }

        return null;
    }

    protected function toAlias(LocaleCode|LocaleData|string|null $locale): ?string
    {
        if ($locale = $this->stringify($locale)) {
            return $this->aliases()->get($locale, $locale);
        }

        return null;
    }

    protected function aliases(): Collection
    {
        return app(ConfigData::class)->main->aliases;
    }

    protected function stringify(LocaleCode|LocaleData|string|null $locale): ?string
    {
        return match (true) {
            $locale instanceof LocaleData => $locale->code,
            $locale instanceof LocaleCode => $locale->value,
            default                       => $locale
        };
    }
}
