<?php

declare(strict_types=1);

namespace YourNamespace\Translations;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelLang\Publisher\Plugins\Provider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        if (class_exists(Provider::class)) {
            $this->app->register(Plugin::class);
        }
    }
}
