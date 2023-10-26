<?php

/**
 * This file is part of the "Laravel-Lang/Locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2022 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/Locales
 */

declare(strict_types=1);

namespace LaravelLang\Locales\Facades\Helpers;

use Illuminate\Support\Facades\Facade;
use LaravelLang\Locales\Enums\Locales as LocaleCode;
use LaravelLang\Locales\Helpers\Locales as Helper;

/**
 * @method static array available()
 * @method static array installed()
 * @method static array installedWithoutProtects()
 * @method static array notInstalled()
 * @method static array protects()
 * @method static bool isAvailable(string|LocaleCode|null $locale)
 * @method static bool isInstalled(string|LocaleCode|null $locale)
 * @method static bool isProtected(string|LocaleCode|null $locale)
 * @method static string getDefault()
 * @method static string getFallback()
 */
class Locales extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Helper::class;
    }
}
