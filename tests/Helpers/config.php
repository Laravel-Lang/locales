<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 *
 * @copyright 2023 Andrey Helldar
 *
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

declare(strict_types=1);

use LaravelLang\Locales\Enums\Config;
use LaravelLang\Locales\Enums\Locales;

function setAlias(Locales $locale, string $alias): void
{
    config()->set(Config::PublicKey->value . '.aliases.' . $locale->value, $alias);
}
