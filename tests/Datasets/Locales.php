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

use LaravelLang\LocaleList\Locale;

dataset('locales', Locale::values());

dataset('incorrect-locales', ['FOO', 'BAR', 'AA', 'BB', 'cc', 'dd', null]);

dataset('aliased-locales', [
    Locale::German->value => [Locale::German, 'de-DE'],
    Locale::French->value => [Locale::French, 'fr-custom'],
]);

dataset('locale-direction-left-to-right', [
    Locale::Afrikaans,
    Locale::Albanian,
    Locale::Armenian,
    Locale::Azerbaijani,
    Locale::Basque,
    Locale::Belarusian,
    Locale::Bengali,
    Locale::Bosnian,
    Locale::Bulgarian,
    Locale::Catalan,
    Locale::CentralKhmer,
    Locale::Chinese,
    Locale::ChineseHongKong,
    Locale::ChineseT,
    Locale::Croatian,
    Locale::Czech,
    Locale::Danish,
    Locale::Dutch,
    Locale::English,
    Locale::Estonian,
    Locale::Finnish,
    Locale::French,
    Locale::Galician,
    Locale::Georgian,
    Locale::German,
    Locale::GermanSwitzerland,
    Locale::Greek,
    Locale::Gujarati,
    Locale::Hindi,
    Locale::Hungarian,
    Locale::Icelandic,
    Locale::Indonesian,
    Locale::Italian,
    Locale::Japanese,
    Locale::Kannada,
    Locale::Kazakh,
    Locale::Korean,
    Locale::Latvian,
    Locale::Lithuanian,
    Locale::Macedonian,
    Locale::Malay,
    Locale::Marathi,
    Locale::Mongolian,
    Locale::Nepali,
    Locale::NorwegianBokmal,
    Locale::NorwegianNynorsk,
    Locale::Occitan,
    Locale::Pilipino,
    Locale::Polish,
    Locale::Portuguese,
    Locale::PortugueseBrazil,
    Locale::Romanian,
    Locale::Russian,
    Locale::Sardinian,
    Locale::SerbianCyrillic,
    Locale::SerbianLatin,
    Locale::SerbianMontenegrin,
    Locale::Sinhala,
    Locale::Slovak,
    Locale::Slovenian,
    Locale::Spanish,
    Locale::Swahili,
    Locale::Swedish,
    Locale::Tagalog,
    Locale::Tajik,
    Locale::Thai,
    Locale::Turkish,
    Locale::Turkmen,
    Locale::Ukrainian,
    Locale::UzbekCyrillic,
    Locale::UzbekLatin,
    Locale::Vietnamese,
    Locale::Welsh,
]);

dataset('locale-direction-right-to-left', [
    Locale::Arabic,
    Locale::Hebrew,
    Locale::Pashto,
    Locale::Persian,
    Locale::Uighur,
    Locale::Urdu,
]);
