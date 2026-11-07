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

use Illuminate\Support\Facades\File;
use LaravelLang\Locales\Helpers\Filesystem;

beforeEach(function () {
    $this->root = lang_path('fs');

    storeFile($this->root . '/a.json', '{}');
    storeFile($this->root . '/vendor/pkg/b.json', '{}');
    storeFile($this->root . '/vendor/pkg/deep/c.php', '<?php');

    File::ensureDirectoryExists($this->root . '/de');
});

it('lists the directories directly below the path, sorted', function () {
    expect(Filesystem::directories($this->root))->toBe(['de', 'vendor']);
    expect(Filesystem::directories($this->root . '/vendor'))->toBe(['pkg']);
});

it('lists files recursively with relative paths, sorted', function () {
    expect(Filesystem::files($this->root))->toBe([
        'a.json',
        'vendor/pkg/b.json',
        'vendor/pkg/deep/c.php',
    ]);
});

it('returns an empty list for a missing directory', function () {
    expect(Filesystem::directories($this->root . '/missing'))->toBe([])
        ->and(Filesystem::files($this->root . '/missing'))->toBe([]);
});

it('does not follow symlinked directories', function () {
    symlink($this->root . '/vendor', $this->root . '/link');

    expect(Filesystem::directories($this->root))->toContain('link')
        ->and(Filesystem::files($this->root))->toBe([
            'a.json',
            'vendor/pkg/b.json',
            'vendor/pkg/deep/c.php',
        ]);
});
