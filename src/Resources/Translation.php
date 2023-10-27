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

namespace LaravelLang\Locales\Resources;

use DragonCode\Contracts\Support\Arrayable;
use DragonCode\Support\Facades\Helpers\Str;
use LaravelLang\Locales\Helpers\Arr;

class Translation implements Arrayable
{
    protected array $source = [];

    protected array $translations = [];

    public function __construct(
        readonly protected Arr $arr = new Arr()
    ) {}

    public function setSource(string $filename, array $values): self
    {
        $this->source[$filename] = $this->merge($this->source[$filename] ?? [], $values);

        return $this;
    }

    public function setTranslations(string $locale, array $values): self
    {
        $this->translations[$locale] = $this->merge($this->translations[$locale] ?? [], $values);

        return $this;
    }

    public function toArray(): array
    {
        $result = [];

        foreach ($this->source as $filename => $keys) {
            foreach ($this->translations as $locale => $values) {
                $name = $this->resolveFilename($filename, $locale);

                $result[$locale][$name] = $this->merge($keys, $values, true);
            }
        }

        ksort($result);

        return $result;
    }

    protected function resolveFilename(string $path, string $locale): string
    {
        return Str::replaceFormat($path, compact('locale'), '{%s}');
    }

    protected function merge(array $source, array $target, bool $filter_keys = false): array
    {
        return $this->arr->merge($source, $target, $filter_keys);
    }
}
