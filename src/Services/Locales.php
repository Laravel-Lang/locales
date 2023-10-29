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

namespace LaravelLang\Locales\Services;

use DragonCode\Support\Facades\Filesystem\Path;
use LaravelLang\Locales\Concerns\Aliases;
use LaravelLang\Locales\Concerns\Pathable;
use LaravelLang\Locales\Concerns\Registry;
use LaravelLang\Locales\Enums\Locale;

class Locales
{
    use Aliases;
    use Pathable;
    use Registry;

    public function available(): array
    {
        return $this->registry(__METHOD__, fn () => Locale::collection()
            ->map(fn (Locale $locale) => $this->toAlias($locale))
            ->filter()
            ->sort()
            ->values()
            ->all()
        );
    }

    public function installed(): array
    {
        return $this->registry(__METHOD__, function () {
            if ($this->directoryDoesntExist()) {
                return $this->protects();
            }

            return collect()
                ->push(
                    $this->directories(),
                    $this->jsons(),
                    $this->protects()
                )
                ->flatten()
                ->map(fn (string $name) => $this->toAlias(Path::filename($name)))
                ->filter(fn (string $locale) => $this->isAvailable($locale))
                ->unique()
                ->sort()
                ->values()
                ->all();
        });
    }

    public function notInstalled(): array
    {
        return $this->registry(__METHOD__, fn () => array_values(array_diff($this->available(), $this->installed())));
    }

    public function protects(): array
    {
        return $this->registry(__METHOD__, fn () => collect([
            $this->getDefault(),
            $this->getFallback(),
        ])->filter()->unique()->sort()->values()->all());
    }

    public function isAvailable(Locale|string|null $locale): bool
    {
        $locales = $this->available();

        return $this->inArray($this->toAlias($locale), $locales)
            || $this->inArray($this->fromAlias($locale), $locales);
    }

    public function isInstalled(Locale|string|null $locale): bool
    {
        return $this->registry([__METHOD__, $locale], function () use ($locale) {
            $locales = $this->installed();

            return $this->inArray($this->fromAlias($locale), $locales)
                || $this->inArray($this->toAlias($locale), $locales);
        });
    }

    public function isProtected(Locale|string|null $locale): bool
    {
        return $this->registry([__METHOD__, $locale], fn () => $this->inArray($locale, $this->protects()));
    }

    public function getDefault(): string
    {
        return $this->registry(__METHOD__, function () {
            $locale = config('app.locale');

            return $this->isAvailable($locale) ? $locale : $this->getFallback();
        });
    }

    public function getFallback(): string
    {
        return $this->registry(__METHOD__, function () {
            $locale = config('app.fallback_locale');

            return $this->isAvailable($locale) ? $locale : Locale::English->value;
        });
    }

    protected function inArray(Locale|string|null $locale, array $haystack): bool
    {
        $locale = $this->toString($locale);

        return ! empty($locale) && in_array($locale, $haystack, true);
    }

    protected function toString(Locale|string|null $locale): ?string
    {
        return $locale?->value ?? $locale;
    }
}
