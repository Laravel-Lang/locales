<?php

declare(strict_types=1);

namespace LaravelLang\Locales\Services;

use Illuminate\Support\Collection;
use LaravelLang\NativeLocaleNames\LocaleData;
use LaravelLang\NativeLocaleNames\LocaleNames;

class DataService
{
    public function __construct(
        protected MainService $service,
        protected LocaleNames $names,
    ) {}

    /** @return Collection<int, LocaleData> */
    public function available(): Collection
    {
        return $this->service->available(false)->map(
            fn (string $locale): LocaleData => $this->map($locale)
        );
    }

    public function current(): LocaleData
    {
        return $this->map(
            $this->service->current(false)
        );
    }

    public function fallback(): LocaleData
    {
        return $this->map(
            $this->service->fallback(false)
        );
    }

    /** @return Collection<int, LocaleData> */
    public function installed(): Collection
    {
        return $this->service->installed(false)->map(
            fn (string $locale): LocaleData => $this->map($locale)
        );
    }

    /** @return Collection<int, LocaleData> */
    public function protects(): Collection
    {
        return $this->service->protects(false)->map(
            fn (string $locale): LocaleData => $this->map($locale)
        );
    }

    /** @return Collection<int, LocaleData> */
    public function uninstalled(): Collection
    {
        return $this->service->uninstalled(false)->map(
            fn (string $locale): LocaleData => $this->map($locale)
        );
    }

    protected function map(string $locale): LocaleData
    {
        return $this->names->one(
            $this->service->current(false),
            $locale,
        );
    }
}
