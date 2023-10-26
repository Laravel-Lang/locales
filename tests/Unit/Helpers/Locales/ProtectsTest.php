<?php

/**
 * This file is part of the "Laravel-Lang/publisher" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2022 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/Laravel-Lang/publisher
 */

namespace Tests\Unit\Helpers\Locales;

use LaravelLang\Publisher\Constants\Locales as LocaleCode;
use LaravelLang\Publisher\Facades\Helpers\Locales;
use Tests\TestCase;

class ProtectsTest extends TestCase
{
    protected LocaleCode $fallback_locale = LocaleCode::ENGLISH;

    public function testDefault(): void
    {
        $this->assertSame(['en'], Locales::protects());
    }

    public function testCustomDefault(): void
    {
        config(['app.locale' => 'de']);

        $this->assertSame(['de', 'en'], Locales::protects());
    }

    public function testCustomFallback(): void
    {
        config(['app.fallback_locale' => 'de']);

        $this->assertSame(['de', 'en'], Locales::protects());
    }

    public function testCustomAll(): void
    {
        config(['app.locale' => 'de']);
        config(['app.fallback_locale' => 'fr']);

        $this->assertSame(['de', 'fr'], Locales::protects());
    }
}
