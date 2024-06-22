<?php

declare(strict_types=1);

namespace App\Foundation;

use Illuminate\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function langPath($path = ''): string
    {
        return $this->joinPaths($this->langPath, $this->parallelToken() . '/' . $path);
    }

    protected function parallelToken(): string
    {
        return $_SERVER['TEST_TOKEN'] ?? '0';
    }
}
