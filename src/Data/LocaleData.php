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
use LaravelLang\Locales\Enums\Orientation;

class LocaleData
{
    use Aliases;

    public readonly string $code;

    public readonly string $type;

    public readonly string $name;

    public readonly string $native;

    public readonly string $localized;

    public readonly ?string $regional;

    public readonly CountryData $country;

    public readonly CurrencyData $currency;

    public readonly Orientation $orientation;

    public function __construct(
        LocaleEnum $locale,
        array $data,
        NativeData $locales,
        NativeData $countries,
        NativeData $currencies
    ) {
        $this->code = $this->toAlias($locale);

        $this->type     = $data['type']     ?? 'Latn';
        $this->regional = $data['regional'] ?? null;

        $this->name      = $locales->getEnglish($this->code);
        $this->native    = $locales->getNative($this->code);
        $this->localized = $locales->getLocalized($this->code);

        $this->orientation = $data['orientation'] ?? Orientation::LeftToRight;

        $this->country  = new CountryData($locale, $countries, $currencies);
        $this->currency = new CurrencyData($locale, $currencies);
    }
}
