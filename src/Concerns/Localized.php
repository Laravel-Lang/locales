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

namespace LaravelLang\Locales\Concerns;

use LaravelLang\Locales\Data\NativeData;
use LaravelLang\Locales\Enums\Locale;
use LaravelLang\NativeLocaleNames\Native;

trait Localized
{
    public function localized(): NativeData
    {
        return $this->registry([__METHOD__, $this->appLocale()], fn () => new NativeData(
            Native::get(Locale::English),
            Native::get(),
            Native::get($this->appLocale())
        ));
    }

    protected function appLocale(): string
    {
        return $this->fromAlias(
            $this->raw->getDefault()
        );
    }
}
