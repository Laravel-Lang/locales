<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Data;

/** @deprecated */
readonly class LocaleData
{
    public readonly string $code;

    public readonly ?string $regional;

    public readonly string $type;

    public readonly string $native;

    public readonly string $localized;

    public readonly ?CountryData $country;

    public readonly ?CurrencyData $currency;

    public readonly DeprecatedDirection|Direction $direction;

    public function __construct(
        public readonly LocaleEnum $locale,
        array $data,
        NativeData $locales,
        ?NativeData $countries,
        ?NativeData $currencies,
    ) {
        $this->code = $this->config()->to($locale);

        $this->type     = $data['type'] ?? 'Latn';
        $this->regional = $data['regional'] ?? null;

        $this->native    = $locales->getNative($this->code);
        $this->localized = $locales->getLocalized($this->code);

        $this->direction = $data['direction'] ?? Direction::LeftToRight;

        $this->country  = $countries ? new CountryData($locale, $countries) : null;
        $this->currency = $currencies ? new CurrencyData($locale, $currencies) : null;
    }

    protected function config(): AliasConfig
    {
        return app(AliasConfig::class);
    }
}
