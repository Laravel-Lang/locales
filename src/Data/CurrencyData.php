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

namespace LaravelLang\Locales\Data;

use LaravelLang\Config\Services\AliasConfig;
use LaravelLang\LocaleList\Locale as LocaleEnum;

class CurrencyData
{
    public readonly string $code;

    public readonly ?int $numeric;

    public readonly string $native;

    public readonly string $localized;

    public function __construct(
        LocaleEnum $locale,
        NativeData $data,
        AliasConfig $alias,
    ) {
        $code = $alias->from($locale);

        $this->code      = $data->getNative($code)->code;
        $this->numeric   = $data->getNative($code)->numeric;
        $this->native    = $data->getNative($code)->native;
        $this->localized = $data->getLocalized($code)->localized;
    }
}
