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

namespace LaravelLang\Locales\Helpers;

use DirectoryIterator;

/** The few filesystem lookups the package needs, built on native PHP only. */
final class Filesystem
{
    /**
     * Names of the directories directly below $path.
     *
     * @return array<string> sorted names relative to $path
     */
    public static function directories(string $path): array
    {
        return self::scan($path, false, true);
    }

    /**
     * Files below $path, including nested directories. Symlinked directories are not followed.
     *
     * @return array<string> sorted paths relative to $path
     */
    public static function files(string $path): array
    {
        return self::scan($path, true, false);
    }

    /** @return array<string> */
    private static function scan(string $root, bool $recursive, bool $directories, string $prefix = ''): array
    {
        if (! is_dir($root)) {
            return [];
        }

        $items = [];

        foreach (new DirectoryIterator($root) as $item) {
            if ($item->isDot()) {
                continue;
            }

            $name = $prefix . $item->getFilename();

            if ($directories ? $item->isDir() : $item->isFile()) {
                $items[] = $name;
            }

            if ($recursive && $item->isDir() && ! $item->isLink()) {
                $items = array_merge($items, self::scan($item->getPathname(), true, $directories, $name . '/'));
            }
        }

        sort($items);

        return $items;
    }
}
