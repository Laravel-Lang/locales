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

use LaravelLang\Config\Services\AliasLangConfig;
use LaravelLang\LocaleList\Locale as LocaleEnum;

class CountryData
{
    public readonly string $code;

    public readonly string $native;

    public readonly string $localized;

    public function __construct(
        LocaleEnum $locale,
        NativeData $data,
    ) {
        $code = $this->config()->from($locale);

        $this->code      = $data->getNative($code)->code;
        $this->native    = $data->getNative($code)->native;
        $this->localized = $data->getLocalized($code)->localized;
    }

    protected function config(): AliasLangConfig
    {
        return app(AliasLangConfig::class);
    }
}
