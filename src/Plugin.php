<?php

declare(strict_types=1);

namespace YourNamespace\Translations;

use LaravelLang\Publisher\Plugins\Provider;
use YourNamespace\Translations\Plugins\Bar;
use YourNamespace\Translations\Plugins\Foo;
use YourNamespace\Translations\Plugins\Main;

class Plugin extends Provider
{
    protected ?string $package_name = 'your/namespace';

    protected string $base_path = __DIR__ . '/../';

    protected array $plugins = [
        Foo::class,
        Bar::class,
        Main::class,
    ];

    public function boot(): void
    {
        $path = function_exists('lang_path') ? lang_path('vendor/custom') : resource_path('lang/vendor/custom');

        $this->loadJsonTranslationsFrom($path);
    }
}
