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

use Composer\InstalledVersions;
use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Foundation\Console\AboutCommand;
use LaravelLang\Locales\Facades\Locales;

trait About
{
    protected function registerAbout(): void
    {
        if (! class_exists(AboutCommand::class)) {
            return;
        }

        $this->pushInformation(fn () => [
            'Installed' => $this->implode(Locales::installed()),
            'Protected' => $this->implode(Locales::protects()),

            'Locales Version' => $this->getPackageVersion('laravel-lang/locales'),
        ]);
    }

    protected function pushInformation(callable $data): void
    {
        AboutCommand::add('Locales', $data);
    }

    protected function getPackageVersion(string $package): string
    {
        if (InstalledVersions::isInstalled($package)) {
            return InstalledVersions::getPrettyVersion($package);
        }

        return '<fg=yellow;options=bold>INCORRECT</>';
    }

    protected function implode(array $values): string
    {
        return Arr::of($values)->sort()->implode(', ')->toString();
    }
}