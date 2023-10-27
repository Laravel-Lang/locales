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

namespace LaravelLang\Locales\Console;

use LaravelLang\Locales\Exceptions\UnknownLocaleCodeException;
use LaravelLang\Locales\Facades\Helpers\Locales;
use LaravelLang\Locales\Processors\Add as AddProcessor;
use LaravelLang\Locales\Processors\Processor;

class Add extends Base
{
    protected $signature = 'lang:add {locales?* : Space-separated list of, eg: de tk it}';

    protected $description = 'Install new localizations.';

    protected ?string $question = 'Do you want to install all localizations?';

    protected Processor|string $processor = AddProcessor::class;

    protected function locales(): array
    {
        if ($this->confirmAll()) {
            return Locales::available();
        }

        $locales = $this->getLocalesArgument();

        foreach ($locales as $locale) {
            if (! Locales::isAvailable($locale)) {
                throw new UnknownLocaleCodeException($locale);
            }
        }

        return $locales;
    }
}
