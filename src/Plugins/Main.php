<?php

declare(strict_types=1);

namespace YourNamespace\Translations\Plugins;

use LaravelLang\Publisher\Plugins\Plugin;

class Main extends Plugin
{
    protected ?string $vendor = 'laravel/framework';

    public function files(): array
    {
        return [
            'en.json'    => '{locale}.json',
            'custom.php' => '{locale}/custom.php',
        ];
    }
}
