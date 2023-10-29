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

namespace LaravelLang\Locales\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Services\Locales as Service;

/**
 * @method static array<string> available()
 * @method static array<string> installed()
 * @method static array<string> notInstalled()
 * @method static array<string> protects()
 * @method static bool isAvailable(string|Locale|null $locale)
 * @method static bool isInstalled(string|Locale|null $locale)
 * @method static bool isProtected(string|Locale|null $locale)
 * @method static string getDefault()
 * @method static string getFallback()
 */
class Locales extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Service::class;
    }
}
