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

namespace LaravelLang\Locales;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelLang\Locales\Concerns\About;
use LaravelLang\Locales\Console\Add;
use LaravelLang\Locales\Console\Remove;
use LaravelLang\Locales\Console\Reset;
use LaravelLang\Locales\Console\Update;
use LaravelLang\Locales\Helpers\Config;

class ServiceProvider extends BaseServiceProvider
{
    use About;

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootCommands();
    }

    public function register(): void
    {
        $this->registerConfig();
        $this->registerAbout();
    }

    protected function bootCommands(): void
    {
        $this->commands([
            Add::class,
            Remove::class,
            Reset::class,
            Update::class,
        ]);
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__ . '/../config/public.php' => $this->app->configPath(Config::PUBLIC_KEY . '.php'),
        ], 'config');
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/public.php', Config::PUBLIC_KEY);
        $this->mergeConfigFrom(__DIR__ . '/../config/private.php', Config::PRIVATE_KEY);
    }
}
