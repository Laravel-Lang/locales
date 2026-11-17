<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Services\LocalesService;
use LaravelLang\NativeLocaleNames\LocaleData;

/**
 * @method static bool isAvailable(Locale|LocaleData|string|null $locale)
 * @method static bool isInstalled(Locale|LocaleData|string|null $locale)
 * @method static bool isProtected(Locale|LocaleData|string|null $locale)
 * @method static Collection<string> available()
 * @method static Collection<string> installed()
 * @method static Collection<string> protects()
 * @method static Collection<string> uninstalled()
 * @method static LocaleData info(Locale|LocaleData|string|null $locale = null)
 * @method static string current()
 * @method static string fallback()
 * @method static string fromAlias(Locale|LocaleData|string|null $locale = null)
 * @method static string toAlias(Locale|LocaleData|string|null $locale = null)
 * @method static void reload()
 * @method static void set(Locale|LocaleData|string|null $locale)
 */
class Locales extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LocalesService::class;
    }
}
