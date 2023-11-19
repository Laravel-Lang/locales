<?php

/**
 * This file is part of the "laravel-lang/locales" project.
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

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Enums\Config;

function setAlias(Locale $locale, string $alias): void
{
    config()->set(Config::PublicKey() . '.aliases.' . $locale->value, $alias);
}

function setLocales(bool|Locale|string|null $main = false, bool|Locale|string|null $fallback = false): void
{
    if (! is_bool($main)) {
        setMainLocale($main);
    }

    if (! is_bool($fallback)) {
        setFallbackLocale($fallback);
    }
}

function setMainLocale(Locale|string|null $locale): void
{
    config()->set('app.locale', $locale->value ?? $locale);
}

function setFallbackLocale(Locale|string|null $locale): void
{
    config()->set('app.fallback_locale', $locale->value ?? $locale);
}
