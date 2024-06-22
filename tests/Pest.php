<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2024 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

use DragonCode\Support\Facades\Filesystem\Directory;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Tests\TestCase;

uses(TestCase::class, WithWorkbench::class)
    ->beforeEach(function () {
        Directory::ensureDelete(lang_path());
        Directory::ensureDirectory(lang_path());
    })
    ->afterAll(function () {
        Directory::ensureDelete(lang_path());
    })->in('Unit');
