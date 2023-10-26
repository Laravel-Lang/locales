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

namespace LaravelLang\Locales\Processors;

use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Console\OutputStyle;
use LaravelLang\Locales\Concerns\Aliases;
use LaravelLang\Locales\Concerns\Decorator;
use LaravelLang\Locales\Concerns\Has;
use LaravelLang\Locales\Concerns\Output;
use LaravelLang\Locales\Concerns\Path;
use LaravelLang\Locales\Constants\Types;
use LaravelLang\Locales\Helpers\Arr as ArrHelper;
use LaravelLang\Locales\Helpers\Config;
use LaravelLang\Locales\Plugins\Plugin;
use LaravelLang\Locales\Resources\Translation;
use LaravelLang\Locales\Services\Filesystem\Manager;
use LaravelLang\Locales\TextDecorator;

abstract class Processor
{
    use Aliases;
    use Decorator;
    use Has;
    use Output;
    use Path;

    protected bool $reset = false;

    protected array $file_types = ['json', 'php'];

    public function __construct(
        readonly protected OutputStyle $output,
        readonly protected array $locales,
        readonly protected TextDecorator $decorator,
        readonly protected Config $config,
        protected Manager $filesystem = new Manager(),
        protected ArrHelper $arr = new ArrHelper(),
        protected Translation $translation = new Translation(
        )
    ) {}

    public function prepare(): self
    {
        return $this;
    }

    public function collect(): self
    {
        foreach ($this->plugins() as $directory => $plugins) {
            $this->info($this->config->getPackageNameByPath($directory, Types::TYPE_CLASS));

            $this->task('Collect source', function () use ($directory, $plugins) {
                /** @var Plugin $plugin */
                foreach ($plugins as $plugin) {
                    $this->collectKeys($directory, $plugin->files());
                }
            });

            $this->collectLocalizations($directory);
        }

        return $this;
    }

    public function store(): void
    {
        $this->info('Storing changes...');

        foreach ($this->translation->toArray() as $locale => $items) {
            foreach ($items as $filename => $values) {
                $this->task($filename, function () use ($filename, $values, $locale) {
                    $path = $this->config->langPath($filename);

                    $values = $this->reset || ! File::exists($path) ? $values : $this->arr->merge($this->filesystem->load($path), $values);

                    $this->filesystem->store($path, $this->decorate($locale, $values));
                });
            }
        }
    }

    protected function collectKeys(string $directory, array $files): void
    {
        foreach ($files as $source => $target) {
            $values = $this->filesystem->load($directory . '/source/' . $source);

            $this->translation->setSource($target, $values);
        }
    }

    protected function collectLocalizations(string $directory): void
    {
        foreach ($this->locales as $locale) {
            $locale = $locale?->value ?? $locale;

            $locale_alias = $this->toAlias($locale, $this->config);

            $this->task('Collecting ' . $locale, function () use ($locale, $locale_alias, $directory) {
                foreach ($this->file_types as $type) {
                    $main_path   = $this->localeFilename($locale_alias, "$directory/locales/$locale/$type.json");
                    $inline_path = $this->localeFilename($locale_alias, "$directory/locales/$locale/$type.json", true);

                    $values = $this->filesystem->load($main_path);

                    if ($main_path !== $inline_path && $this->config->hasInline()) {
                        $values = $this->arr->merge($values, $this->filesystem->load($inline_path));
                    }

                    $this->translation->setTranslations($locale_alias, $values);
                }
            });
        }
    }

    /**
     * @return array<\LaravelLang\Locales\Plugins\Plugin>
     */
    protected function plugins(): array
    {
        return $this->arr->of($this->config->getPlugins())
            ->map(function (array $plugins): array {
                return $this->arr->of($plugins)
                    ->map(static fn (string $plugin) => new $plugin())
                    ->filter(static fn (Plugin $plugin) => $plugin->has())
                    ->toArray();
            })
            ->filter()
            ->toArray();
    }
}
