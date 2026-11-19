<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Enums;

/**
 * @deprecated Use the \LaravelLang\LocaleList\Direction instead
 */
enum Direction: string
{
    case LeftToRight = 'ltr';
    case RightToLeft = 'rtl';
}
