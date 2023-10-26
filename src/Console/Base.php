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

namespace LaravelLang\Locales\Console;

use Illuminate\Console\Command;
use LaravelLang\Locales\Facades\Helpers\Locales;
use LaravelLang\Locales\Helpers\Config;
use LaravelLang\Locales\Processors\Processor;
use LaravelLang\Locales\Services\Converters\Text\CommonDecorator;
use LaravelLang\Locales\Services\Converters\Text\SmartPunctuationDecorator;
use LaravelLang\Locales\TextDecorator;

abstract class Base extends Command
{
    protected ?string $question;

    protected Processor|string $processor;

    public function handle()
    {
        $this->resolveProcessor()->prepare()->collect()->store();

        $this->output->newLine();
    }

    protected function resolveProcessor(): Processor
    {
        $config = $this->config();

        return new $this->processor($this->output, $this->locales(), $this->decorator($config), $config);
    }

    protected function locales(): array
    {
        return Locales::installed();
    }

    protected function decorator(Config $config): TextDecorator
    {
        return $config->hasSmartPunctuation() ? new SmartPunctuationDecorator($config) : new CommonDecorator($config);
    }

    protected function config(): Config
    {
        return new Config();
    }

    protected function confirmAll(): bool
    {
        if (empty($this->argument('locales')) && $question = $this->question) {
            return $this->confirm($question);
        }

        return false;
    }

    protected function getLocalesArgument(): array
    {
        $locales = $this->argument('locales');

        return is_array($locales) ? $locales : [$locales];
    }
}
