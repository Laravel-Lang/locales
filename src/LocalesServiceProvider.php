<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2025 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

namespace LaravelLang\Locales;

use Closure;
use Composer\InstalledVersions;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelLang\Locales\Facades\Locales;

class LocalesServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->about();
    }

    protected function about(): void
    {
        $this->pushInformation(fn () => [
            'Installed' => $this->implode(Locales::raw()->installed()),
            'Protected' => $this->implode(Locales::raw()->protects()),

            'Version' => $this->getPackageVersion('laravel-lang/locales'),
        ]);
    }

    protected function pushInformation(Closure $data): void
    {
        AboutCommand::add('Locales', $data);
    }

    protected function getPackageVersion(string $package): string
    {
        if (InstalledVersions::isInstalled($package)) {
            return InstalledVersions::getPrettyVersion($package);
        }

        return '<fg=yellow;options=bold>UNKNOWN</>';
    }

    protected function implode(array $values): string
    {
        return (new Collection($values))
            ->sort()
            ->implode(', ');
    }
}
