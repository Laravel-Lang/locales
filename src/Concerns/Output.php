<?php

/**
 * This file is part of the "Laravel-Lang/Locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2022 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/Locales
 */

declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use DragonCode\Support\Facades\Helpers\Str;
use DragonCode\Support\Facades\Instances\Call;
use Illuminate\Console\View\Components\Factory;

trait Output
{
    /** @var Factory */
    protected mixed $components = null;

    protected function info(string $message, string $style = 'fg=green'): void
    {
        if ($this->hasComponentFactory()) {
            $this->emptyLine();

            $this->componentFactory()->info($message);

            return;
        }
        $this->outputLine($message, $style);
    }

    protected function line(string $message, ?string $style = null): void
    {
        $this->hasComponentFactory()
            ? $this->componentFactory()->task($message)
            : $this->outputLine($message, $style);
    }

    protected function task(string $message, callable $callback): void
    {
        if ($this->hasComponentFactory()) {
            $this->componentFactory()->task($message, $callback);

            return;
        }

        $this->outputLine(Str::end($message, '...'));

        Call::callback($callback);
    }

    protected function emptyLine(): void
    {
        $this->output->newLine();
    }

    protected function outputLine(string $message, ?string $style = null): void
    {
        $line = ! empty($style) ? sprintf('<%s>%s</>', $style, $message) : $message;

        $this->output->writeln($line);
    }

    protected function hasComponentFactory(): bool
    {
        return class_exists(Factory::class);
    }

    protected function componentFactory(): Factory
    {
        if (! empty($this->components)) {
            return $this->components;
        }

        return $this->components = new Factory($this->output);
    }
}
