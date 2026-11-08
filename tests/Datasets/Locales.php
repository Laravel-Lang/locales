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
    Locale::Amharic,
    Locale::Armenian,
    Locale::Assamese,
    Locale::Azerbaijani,
    Locale::Bambara,
    Locale::Basque,
    Locale::Belarusian,
    Locale::Bengali,
    Locale::Bhojpuri,
    Locale::Bosnian,
    Locale::Bulgarian,
    Locale::Catalan,
    Locale::Cebuano,
    Locale::CentralKhmer,
    Locale::Chinese,
    Locale::ChineseHongKong,
    Locale::ChineseT,
    Locale::Croatian,
    Locale::Czech,
    Locale::Danish,
    Locale::Dogri,
    Locale::Dutch,
    Locale::English,
    Locale::Esperanto,
    Locale::Estonian,
    Locale::Ewe,
    Locale::Finnish,
    Locale::French,
    Locale::Frisian,
    Locale::Galician,
    Locale::Georgian,
    Locale::German,
    Locale::GermanSwitzerland,
    Locale::Greek,
    Locale::Gujarati,
    Locale::Hausa,
    Locale::Hawaiian,
    Locale::Hindi,
    Locale::Hungarian,
    Locale::Icelandic,
    Locale::Igbo,
    Locale::Indonesian,
    Locale::Irish,
    Locale::Italian,
    Locale::Japanese,
    Locale::Kannada,
    Locale::Kazakh,
    Locale::Kinyarwanda,
    Locale::Korean,
    Locale::Kurdish,
    Locale::Kyrgyz,
    Locale::Lao,
    Locale::Latvian,
    Locale::Lingala,
    Locale::Lithuanian,
    Locale::Luganda,
    Locale::Luxembourgish,
    Locale::Macedonian,
    Locale::Maithili,
    Locale::Malagasy,
    Locale::Malay,
    Locale::Malayalam,
    Locale::Maltese,
    Locale::Maori,
    Locale::Marathi,
    Locale::MeiteilonManipuri,
    Locale::Mongolian,
    Locale::MyanmarBurmese,
    Locale::Nepali,
    Locale::NorwegianBokmal,
    Locale::NorwegianNynorsk,
    Locale::Occitan,
    Locale::OdiaOriya,
    Locale::Oromo,
    Locale::Pilipino,
    Locale::Polish,
    Locale::Portuguese,
    Locale::PortugueseBrazil,
    Locale::Punjabi,
    Locale::Quechua,
    Locale::Romanian,
    Locale::Russian,
    Locale::Sanskrit,
    Locale::Sardinian,
    Locale::ScotsGaelic,
    Locale::SerbianCyrillic,
    Locale::SerbianLatin,
    Locale::SerbianMontenegrin,
    Locale::Shona,
    Locale::Sinhala,
    Locale::Slovak,
    Locale::Slovenian,
    Locale::Somali,
    Locale::Spanish,
    Locale::Sundanese,
    Locale::Swahili,
    Locale::Swedish,
    Locale::Tagalog,
    Locale::Tajik,
    Locale::Tamil,
    Locale::Tatar,
    Locale::Telugu,
    Locale::Thai,
    Locale::Tigrinya,
    Locale::Turkish,
    Locale::Turkmen,
    Locale::TwiAkan,
    Locale::Ukrainian,
    Locale::UzbekCyrillic,
    Locale::UzbekLatin,
    Locale::Vietnamese,
    Locale::Welsh,
    Locale::Xhosa,
    Locale::Yiddish,
    Locale::Yoruba,
    Locale::Zulu,
]);

dataset('locale-direction-right-to-left', [
    Locale::Arabic,
    Locale::Hebrew,
    Locale::KurdishSorani,
    Locale::Pashto,
    Locale::Persian,
    Locale::Sindhi,
    Locale::Uighur,
    Locale::Urdu,
]);
