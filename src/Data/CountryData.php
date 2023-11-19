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

namespace LaravelLang\Locales\Data;

use LaravelLang\LocaleList\Locale as LocaleEnum;
use LaravelLang\Locales\Concerns\Aliases;

class CountryData
{
    use Aliases;

    public readonly string $code;

    public readonly string $name;

    public readonly string $native;

    public readonly string $localized;

    public function __construct(LocaleEnum $locale, NativeData $countries, NativeData $currencies)
    {
        $code = $this->fromAlias($locale);

        $this->code = $currencies->getEnglish($code)->country;

        $this->name      = $countries->getEnglish($code);
        $this->native    = $countries->getNative($code);
        $this->localized = $countries->getLocalized($code);
    }
}
