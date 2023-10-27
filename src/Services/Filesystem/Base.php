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

namespace LaravelLang\Locales\Services\Filesystem;

use DragonCode\Contracts\Support\Filesystem;
use DragonCode\PrettyArray\Services\File as Pretty;
use DragonCode\PrettyArray\Services\Formatter;
use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Arr;
use LaravelLang\Locales\Concerns\Has;
use LaravelLang\Locales\Helpers\Config;

abstract class Base implements Filesystem
{
    use Has;

    public function __construct(
        protected Pretty $pretty = new Pretty(),
        protected Formatter $formatter = new Formatter(),
        protected Config $config = new Config(
        )
    ) {
        $this->formatter->setKeyAsString();

        if ($this->config->hasAlign()) {
            $this->formatter->setEqualsAlign();
        }
    }

    public function load(string $path): array
    {
        if (File::exists($path)) {
            return File::load($path);
        }

        return [];
    }

    protected function sort(array $items): array
    {
        return Arr::ksort($items);
    }
}
