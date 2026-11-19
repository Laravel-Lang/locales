<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Data;

use LaravelLang\Config\Services\AliasLangConfig;
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
    ) {
        $code = $this->config()->from($locale);

        $this->code      = $data->getNative($code)->code;
        $this->numeric   = $data->getNative($code)->numeric;
        $this->native    = $data->getNative($code)->native;
        $this->localized = $data->getLocalized($code)->localized;
    }

    protected function config(): AliasLangConfig
    {
        return app(AliasLangConfig::class);
    }
}
