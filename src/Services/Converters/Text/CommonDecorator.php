<?php

/**
 * This file is part of the "laravel-Lang/locales" project.
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

namespace LaravelLang\Locales\Services\Converters\Text;

class CommonDecorator extends BaseDecorator
{
    public function convert(string $locale, string $value): string
    {
        return $value;
    }
}
