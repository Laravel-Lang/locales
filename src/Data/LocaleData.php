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

use LaravelLang\Config\Data\Hidden\LocaleMapData;
use LaravelLang\LocaleList\Direction;
use LaravelLang\LocaleList\Locale as LocaleEnum;
use LaravelLang\Locales\Concerns\Aliases;

readonly class LocaleData
{
    use Aliases;

    public string $code;

    public ?string $regional;

    public string $type;

    public string $native;

    public string $localized;

    public ?CountryData $country;

    public ?CurrencyData $currency;

    public Direction $direction;

    public function __construct(
        public LocaleEnum $locale,
        LocaleMapData $data,
        NativeData $locales,
        ?NativeData $countries,
        ?NativeData $currencies
    ) {
        $this->code = $this->toAlias($locale);

        $this->type      = $data->type;
        $this->regional  = $data->regional;
        $this->direction = $data->direction;

        $this->native    = $locales->getNative($this->code);
        $this->localized = $locales->getLocalized($this->code);

        $this->country  = $countries ? new CountryData($locale, $countries) : null;
        $this->currency = $currencies ? new CurrencyData($locale, $currencies) : null;
    }
}
