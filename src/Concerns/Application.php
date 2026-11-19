<?php


declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use LaravelLang\LocaleList\Locale;

trait Application
{
    protected function appLocale(): string
    {
        return config('app.locale') ?: Locale::English->value;
    }
}
