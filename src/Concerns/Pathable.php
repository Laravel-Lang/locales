<?php


declare(strict_types=1);

namespace LaravelLang\Locales\Concerns;

use Illuminate\Support\Collection;

trait Pathable
{
    protected function directoryExists(): bool
    {
        return is_dir(lang_path());
    }

    protected function directoryDoesntExist(): bool
    {
        return ! $this->directoryExists();
    }

    protected function directories(string $path = ''): array
    {
        return collect(Directory::names(lang_path($path)))
            ->when(
                fn (Collection $items) => $items->contains('vendor'),
                fn (Collection $items) => $items->merge(
                    collect($this->directories('vendor'))->map(
                        fn (string $folder) => $this->directories('vendor/' . $folder)
                    )
                )
            )
            ->flatten()
            ->all();
    }

    protected function jsons(): array
    {
        return File::names(lang_path(), recursive: true);
    }
}
