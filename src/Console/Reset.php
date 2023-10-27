<?php

/**
 * This file is part of the "laravel-Lang/locales" project.
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

namespace LaravelLang\Locales\Console;

use LaravelLang\Locales\Processors\Processor;
use LaravelLang\Locales\Processors\Reset as ResetProcessor;

class Reset extends Base
{
    protected $signature = 'lang:reset';

    protected $description = 'Resets installed localizations.';

    protected ?string $question = 'Are you sure you want to reset localization files?';

    protected Processor|string $processor = ResetProcessor::class;

    public function handle()
    {
        if ($this->confirm($this->question)) {
            parent::handle();
        }
    }
}
