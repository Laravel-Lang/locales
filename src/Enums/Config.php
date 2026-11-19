<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Enums;

use ArchTech\Enums\InvokableCases;

/**
 * @deprecated Use \LaravelLang\Config\Enums\Name instead
 *
 * @method static string PublicKey()
 * @method static string PrivateKey()
 */
enum Config: string
{
    use InvokableCases;

    case PublicKey = 'localization';
    case PrivateKey = 'localization-private';
}
