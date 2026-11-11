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
use Tests\TestCase;

pest()
    ->printer()
    ->compact();

pest()
    ->uses(TestCase::class)
    ->in('Unit')
    ->beforeEach(function () {
        File::deleteDirectory(lang_path());
        File::ensureDirectoryExists(lang_path());
    });
