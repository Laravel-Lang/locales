<?php


declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use Closure;
use LaravelLang\Locales\Services\ResolverService;

trait Registry
{
    protected array $registry = [];

    public function clearRegistryCache(): void
    {
        $this->registry = [];
    }

    protected function registry(array|string $key, Closure $callback): mixed
    {
        $key = $this->registryKey($key);

        return $this->registry[$key] ??= $callback();
    }

    protected function registryKey(array|string $key): string
    {
        return collect($key)
            ->map(static fn (mixed $item) => (string) ResolverService::fromMixed($item))
            ->implode(':');
    }
}
