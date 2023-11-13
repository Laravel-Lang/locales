<?php

/**
 * This file is part of the "laravel-lang/locales" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Laravel Lang Team
 * @license MIT
 *
 * @see https://laravel-lang.com
 */

declare(strict_types=1);

dataset('localized', [
    'English for English' => ['en', 'en', 'English', 'English', 'English'],
    'English for Russian' => ['en', 'ru', 'English', 'English', 'Английский'],
    'English for French'  => ['en', 'fr', 'English', 'English', 'Anglais'],

    'French for English' => ['fr', 'en', 'French', 'Français', 'French'],
    'French for Russian' => ['fr', 'ru', 'French', 'Français', 'Французский'],
    'French for French'  => ['fr', 'fr', 'French', 'Français', 'Français'],

    'Bengali for English' => ['bn', 'en', 'Bengali', 'বাংলা', 'Bengali'],
    'Bengali for Russian' => ['bn', 'ru', 'Bengali', 'বাংলা', 'Бенгальский'],
    'Bengali for French'  => ['bn', 'fr', 'Bengali', 'বাংলা', 'Bengali'],
]);
