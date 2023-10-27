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

use LaravelLang\Locales\Exceptions\ProtectedLocaleException;
use LaravelLang\Locales\Exceptions\UnknownLocaleCodeException;
use LaravelLang\Locales\Facades\Helpers\Locales;
use LaravelLang\Locales\Processors\Processor;
use LaravelLang\Locales\Processors\Remove as RemoveProcessor;

class Remove extends Base
{
    protected $signature = 'lang:rm {locales?* : Space-separated list of, eg: de tk it} {--force : Forced deletion of localization}';

    protected $description = 'Remove localizations.';

    protected ?string $question = 'Do you want to remove all localizations?';

    protected Processor|string $processor = RemoveProcessor::class;

    protected function locales(): array
    {
        if ($this->confirmAll()) {
            return Locales::installedWithoutProtects();
        }

        $locales = $this->getLocalesArgument();

        foreach ($locales as $locale) {
            if (! Locales::isAvailable($locale)) {
                throw new UnknownLocaleCodeException($locale);
            }

            if (Locales::isProtected($locale) && ! $this->option('force')) {
                throw new ProtectedLocaleException($locale);
            }
        }

        return $locales;
    }
}
