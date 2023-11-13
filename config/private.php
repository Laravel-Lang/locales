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

use LaravelLang\Locales\Enums\Locale;
use LaravelLang\Locales\Enums\Orientation;

return [
    'map' => [
        Locale::Afrikaans->value => [
            'type'     => 'Latn',
            'regional' => 'af_ZA',
        ],

        Locale::Albanian->value => [
            'type'     => 'Latn',
            'regional' => 'sq_AL',
        ],

        Locale::Arabic->value => [
            'type'     => 'Arab',
            'regional' => 'ar_AE',

            'orientation' => Orientation::RightToLeft,
        ],

        Locale::Armenian->value => [
            'type'     => 'Armn',
            'regional' => 'hy_AM',
        ],

        Locale::Azerbaijani->value => [
            'type'     => 'Latn',
            'regional' => 'az_AZ',
        ],

        Locale::Basque->value => [
            'type'     => 'Latn',
            'regional' => 'eu_ES',
        ],

        Locale::Belarusian->value => [
            'type'     => 'Cyrl',
            'regional' => 'be_BY',
        ],

        Locale::Bengali->value => [
            'type'     => 'Beng',
            'regional' => 'bn_BD',
        ],

        Locale::Bosnian->value => [
            'type'     => 'Latn',
            'regional' => 'bs_BA',
        ],

        Locale::Bulgarian->value => [
            'type'     => 'Cyrl',
            'regional' => 'bg_BG',
        ],

        Locale::Catalan->value => [
            'type'     => 'Latn',
            'regional' => 'ca_ES',
        ],

        Locale::CentralKhmer->value => [
            'type'     => 'Khmr',
            'regional' => 'km_KH',
        ],

        Locale::Chinese->value => [
            'type'     => 'Hans',
            'regional' => 'zh_CN',
        ],

        Locale::ChineseHongKong->value => [
            'type'     => 'Hans',
            'regional' => 'zh_HK',
        ],

        Locale::ChineseT->value => [
            'type'     => 'Hans',
            'regional' => 'zh_TW',
        ],

        Locale::Croatian->value => [
            'type'     => 'Latn',
            'regional' => 'hr_HR',
        ],

        Locale::Czech->value => [
            'type'     => 'Latn',
            'regional' => 'cs_CZ',
        ],

        Locale::Danish->value => [
            'type'     => 'Latn',
            'regional' => 'da_DK',
        ],

        Locale::Dutch->value => [
            'type'     => 'Latn',
            'regional' => 'nl_NL',
        ],

        Locale::English->value => [
            'type'     => 'Latn',
            'regional' => 'en_GB',
        ],

        Locale::Estonian->value => [
            'type'     => 'Latn',
            'regional' => 'et_EE',
        ],

        Locale::Finnish->value => [
            'type'     => 'Latn',
            'regional' => 'fi_FI',
        ],

        Locale::French->value => [
            'type'     => 'Latn',
            'regional' => 'fr_FR',
        ],

        Locale::Galician->value => [
            'type'     => 'Latn',
            'regional' => 'gl_ES',
        ],

        Locale::Georgian->value => [
            'type'     => 'Geor',
            'regional' => 'ka_GE',
        ],

        Locale::German->value => [
            'type'     => 'Latn',
            'regional' => 'de_DE',
        ],

        Locale::GermanSwitzerland->value => [
            'type'     => 'Latn',
            'regional' => 'de_CH',
        ],

        Locale::Greek->value => [
            'type'     => 'Grek',
            'regional' => 'el_GR',
        ],

        Locale::Gujarati->value => [
            'type'     => 'Gujr',
            'regional' => 'gu_IN',
        ],

        Locale::Hebrew->value => [
            'type'     => 'Hebr',
            'regional' => 'he_IL',

            'orientation' => Orientation::RightToLeft,
        ],

        Locale::Hindi->value => [
            'type'     => 'Deva',
            'regional' => 'hi_IN',
        ],

        Locale::Hungarian->value => [
            'type'     => 'Latn',
            'regional' => 'hu_HU',
        ],

        Locale::Icelandic->value => [
            'type'     => 'Latn',
            'regional' => 'is_IS',
        ],

        Locale::Indonesian->value => [
            'type'     => 'Latn',
            'regional' => 'id_ID',
        ],

        Locale::Italian->value => [
            'type'     => 'Latn',
            'regional' => 'it_IT',
        ],

        Locale::Japanese->value => [
            'type'     => 'Jpan',
            'regional' => 'ja_JP',
        ],

        Locale::Kannada->value => [
            'type'     => 'Knda',
            'regional' => 'kn_IN',
        ],

        Locale::Kazakh->value => [
            'type'     => 'Cyrl',
            'regional' => 'kk_KZ',
        ],

        Locale::Korean->value => [
            'type'     => 'Hang',
            'regional' => 'ko_KR',
        ],

        Locale::Latvian->value => [
            'type'     => 'Latn',
            'regional' => 'lv_LV',
        ],

        Locale::Lithuanian->value => [
            'type'     => 'Latn',
            'regional' => 'lt_LT',
        ],

        Locale::Macedonian->value => [
            'type'     => 'Cyrl',
            'regional' => 'mk_MK',
        ],

        Locale::Malay->value => [
            'type'     => 'Latn',
            'regional' => 'ms_MY',
        ],

        Locale::Marathi->value => [
            'type'     => 'Deva',
            'regional' => 'mr_IN',
        ],

        Locale::Mongolian->value => [
            'type'     => 'Mong',
            'regional' => 'mn_MN',
        ],

        Locale::Nepali->value => [
            'type'     => 'Deva',
            'regional' => 'ne',
        ],

        Locale::NorwegianBokmal->value => [
            'type'     => 'Latn',
            'regional' => 'nb_NO',
        ],

        Locale::NorwegianNynorsk->value => [
            'type'     => 'Latn',
            'regional' => 'nn_NO',
        ],

        Locale::Occitan->value => [
            'type'     => 'Latn',
            'regional' => 'oc_FR',
        ],

        Locale::Pashto->value => [
            'type'     => 'Arab',
            'regional' => 'ps_AF',

            'orientation' => Orientation::RightToLeft,
        ],

        Locale::Persian->value => [
            'type'     => 'Arab',
            'regional' => 'fa_IR',

            'orientation' => Orientation::RightToLeft,
        ],

        Locale::Pilipino->value => [
            'type'     => 'Latn',
            'regional' => 'fil_PH',
        ],

        Locale::Polish->value => [
            'type'     => 'Latn',
            'regional' => 'pl_PL',
        ],

        Locale::Portuguese->value => [
            'type'     => 'Latn',
            'regional' => 'pt_PT',
        ],

        Locale::PortugueseBrazil->value => [
            'type'     => 'Latn',
            'regional' => 'pt_BR',
        ],

        Locale::Romanian->value => [
            'type'     => 'Latn',
            'regional' => 'ro_RO',
        ],

        Locale::Russian->value => [
            'type'     => 'Cyrl',
            'regional' => 'ru_RU',
        ],

        Locale::Sardinian->value => [
            'type'     => 'Latn',
            'regional' => 'sc_IT',
        ],

        Locale::SerbianCyrillic->value => [
            'type'     => 'Cyrl',
            'regional' => 'sr_RS',
        ],

        Locale::SerbianLatin->value => [
            'type'     => 'Latn',
            'regional' => 'sr_RS',
        ],

        Locale::SerbianMontenegrin->value => [
            'type'     => 'Latn',
            'regional' => 'sr_Latn_ME',
        ],

        Locale::Sinhala->value => [
            'type'     => 'Sinh',
            'regional' => 'si_LK',
        ],

        Locale::Slovak->value => [
            'type'     => 'Latn',
            'regional' => 'sk_SK',
        ],

        Locale::Slovenian->value => [
            'type'     => 'Latn',
            'regional' => 'sl_SI',
        ],

        Locale::Spanish->value => [
            'type'     => 'Latn',
            'regional' => 'es_ES',
        ],

        Locale::Swahili->value => [
            'type'     => 'Latn',
            'regional' => 'sw_KE',
        ],

        Locale::Swedish->value => [
            'type'     => 'Latn',
            'regional' => 'sv_SE',
        ],

        Locale::Tagalog->value => [
            'type'     => 'Latn',
            'regional' => 'tl_PH',
        ],

        Locale::Tajik->value => [
            'type'     => 'Cyrl',
            'regional' => 'tg_TJ',
        ],

        Locale::Thai->value => [
            'type'     => 'Thai',
            'regional' => 'th_TH',
        ],

        Locale::Turkish->value => [
            'type'     => 'Latn',
            'regional' => 'tr_TR',
        ],

        Locale::Turkmen->value => [
            'type'     => 'Cyrl',
            'regional' => 'tk_TM',
        ],

        Locale::Uighur->value => [
            'type'     => 'Arab',
            'regional' => 'ug_CN',

            'orientation' => Orientation::RightToLeft,
        ],

        Locale::Ukrainian->value => [
            'type'     => 'Cyrl',
            'regional' => 'uk_UA',
        ],

        Locale::Urdu->value => [
            'type'     => 'Arab',
            'regional' => 'ur_PK',

            'orientation' => Orientation::RightToLeft,
        ],

        Locale::UzbekCyrillic->value => [
            'type'     => 'Cyrl',
            'regional' => 'uz_UZ',
        ],

        Locale::UzbekLatin->value => [
            'type'     => 'Latn',
            'regional' => 'uz_UZ',
        ],

        Locale::Vietnamese->value => [
            'type'     => 'Latn',
            'regional' => 'vi_VN',
        ],

        Locale::Welsh->value => [
            'type'     => 'Latn',
            'regional' => 'cy_GB',
        ],
    ],
];
