<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Services;

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Data\LocaleData;
use stdClass;

class ResolverService
{
    public static function fromMixed(mixed $locale): ?string
    {
        if ($locale instanceof LocaleData) {
            return $locale->code;
        }

        if ($locale instanceof Locale) {
            return $locale->value;
        }

        if (is_object($locale) || is_array($locale) || $locale instanceof stdClass) {
            return null;
        }

        return static::toString((string) $locale);
    }

    public static function toString(Locale|LocaleData|string|null $locale): ?string
    {
        if ($locale instanceof LocaleData) {
            return $locale->code->value;
        }

        return $locale?->value ?? $locale;
    }
}
