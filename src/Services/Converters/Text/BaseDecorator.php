<?php

/**
 * This file is part of the "Laravel-Lang/Locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/Locales
 */

declare(strict_types=1);

namespace LaravelLang\Locales\Services\Converters\Text;

use LaravelLang\Locales\Helpers\Config;
use LaravelLang\Locales\TextDecorator;

abstract class BaseDecorator implements TextDecorator
{
    public function __construct(
        protected Config $config
    ) {}
}
