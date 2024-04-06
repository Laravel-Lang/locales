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

use LaravelLang\LocaleList\Locale;
use LaravelLang\Locales\Enums\Direction;
use LaravelLang\Locales\Facades\Locales;

it('checks locale information without checking its installation', function (string $locale) {
    expect(Locales::info($locale))
        ->code->toBeString()->toBe($locale)
        ->type->toBeString()->toBeIn([
            'Arab',
            'Armn',
            'Beng',
            'Cyrl',
            'Deva',
            'Ethi',
            'Geor',
            'Grek',
            'Gujr',
            'Guru',
            'Hang',
            'Hans',
            'Hebr',
            'Jpan',
            'Khmr',
            'Knda',
            'Laoo',
            'Latn',
            'Mlym',
            'Mong',
            'Mymr',
            'Orya',
            'Sinh',
            'Taml',
            'Telu',
            'Thai',
        ])
        ->native->toBeString()
        ->localized->toBeString()
        ->direction->toBeIn([Direction::LeftToRight, Direction::RightToLeft]);
})->with('locales');

it('checks the Latn locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Latn');
})->with('locale-type-latn');

it('checks the Armn locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Armn');
})->with('locale-type-armn');

it('checks the Cyrl locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Cyrl');
})->with('locale-type-cyrl');

it('checks the Arab locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Arab');
})->with('locale-type-arab');

it('checks the Beng locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Beng');
})->with('locale-type-beng');

it('checks the Khmr locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Khmr');
})->with('locale-type-khmr');

it('checks the Hans locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Hans');
})->with('locale-type-hans');

it('checks the Geor locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Geor');
})->with('locale-type-geor');

it('checks the Grek locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Grek');
})->with('locale-type-grek');

it('checks the Gujr locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Gujr');
})->with('locale-type-gujr');

it('checks the Hebr locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Hebr');
})->with('locale-type-hebr');

it('checks the Deva locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Deva');
})->with('locale-type-deva');

it('checks the Jpan locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Jpan');
})->with('locale-type-jpan');

it('checks the Knda locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Knda');
})->with('locale-type-knda');

it('checks the Hang locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Hang');
})->with('locale-type-hang');

it('checks the Mong locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Mong');
})->with('locale-type-mong');

it('checks the Sinh locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Sinh');
})->with('locale-type-sinh');

it('checks the Thai locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Thai');
})->with('locale-type-thai');

it('checks the Ethi locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Ethi');
})->with('locale-type-ethi');

it('checks the Laoo locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Laoo');
})->with('locale-type-laoo');

it('checks the Mlym locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Mlym');
})->with('locale-type-mlym');

it('checks the Mymr locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Mymr');
})->with('locale-type-mymr');

it('checks the Orya locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Orya');
})->with('locale-type-orya');

it('checks the Guru locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Guru');
})->with('locale-type-guru');

it('checks the Taml locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Taml');
})->with('locale-type-taml');

it('checks the Telu locale type', function (Locale $locale) {
    expect(Locales::info($locale))->type->toBe('Telu');
})->with('locale-type-telu');

it('checking information for incorrect locale', function (?string $locale) {
    expect(Locales::info($locale))
        ->code->toBeString()->toBe('en')
        ->type->toBeString()->toBe('Latn')
        ->native->toBeString()->toBe('English')
        ->localized->toBeString()->toBe('English')
        ->direction->toBe(Direction::LeftToRight);
})->with('incorrect-locales');

it('returns the correct localized name if the non-default locale is set', function () {
    createLocales(Locale::German, Locale::English);

    Locales::set(Locale::English);

    expect(Locales::info(Locale::German))
        ->localized->toBeString()->toBe('German');

    Locales::set(Locale::German);

    expect(Locales::info(Locale::German))
        ->localized->toBeString()->toBe('Deutsch');
});
