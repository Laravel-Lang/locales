<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2023 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

use LaravelLang\Locales\Enums\Config;
use LaravelLang\Locales\Enums\Locales;

function setAlias(Locales $locale, string $alias): void
{
    config()->set(Config::PublicKey->value . '.aliases.' . $locale->value, $alias);
}

function setLocales(Locales|string|null $main = null, Locales|string|null $fallback = null): void
{
    if ($main) {
        setMainLocale($main);
    }

    if ($fallback) {
        setFallbackLocale($fallback);
    }
}

function setMainLocale(Locales|string $locale): void
{
    config()->set('app.locale', $locale->value ?? $locale);
}

function setFallbackLocale(Locales|string $locale): void
{
    config()->set('app.fallback_locale', $locale->value ?? $locale);
}
