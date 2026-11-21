<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Services\DataService;
use LaravelLang\Locales\Services\MainService;
use LaravelLang\NativeLocaleNames\LocaleData;

/**
 * @method static bool isAvailable(Locale|LocaleData|string|null $locale)
 * @method static bool isInstalled(Locale|LocaleData|string|null $locale)
 * @method static bool isProtected(Locale|LocaleData|string|null $locale)
 * @method static Collection<int, string> available(bool $aliased = true)
 * @method static Collection<int, string> installed(bool $aliased = true)
 * @method static Collection<int, string> protects(bool $aliased = true)
 * @method static Collection<int, string> uninstalled(bool $aliased = true)
 * @method static LocaleData info(Locale|LocaleData|string|null $locale = null)
 * @method static DataService data()
 * @method static string current(bool $aliased = true)
 * @method static string fallback(bool $aliased = true)
 * @method static string|null fromAlias(Locale|LocaleData|string|null $locale = null)
 * @method static string|null toAlias(Locale|LocaleData|string|null $locale = null)
 * @method static void reload()
 * @method static void set(Locale|LocaleData|string|null $locale)
 */
final class Locales extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MainService::class;
    }
}
