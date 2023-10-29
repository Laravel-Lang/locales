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

namespace LaravelLang\Locales\Concerns;

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Filesystem\File;

trait Pathable
{
    protected function existsLangDirectory(): bool
    {
        return Directory::exists(lang_path());
    }

    protected function doesntExistLangDirectory(): bool
    {
        return ! $this->existsLangDirectory();
    }

    protected function directoryNames(): array
    {
        return Directory::names(lang_path());
    }

    protected function fileNames(): array
    {
        return File::names(lang_path(), recursive: true);
    }
}
