<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
        [
            [
                'item' => 'siteName',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteDescription',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteSlogan',
                'value' => 'Slogan',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'facebook',
                'value' => 'facebook',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'instagram',
                'value' => 'instagram',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'youtube',
                'value' => 'youtube',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'linkedin',
                'value' => 'linkedin',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'pinterest',
                'value' => 'pinterest',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'twitter',
                'value' => 'twitter',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'whatsapp',
                'value' => 'whatsapp',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'discord',
                'value' => 'discord',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'telefon1',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'telefon2',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'telefon3',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'email1',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'email2',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'email3',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'adres1',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'adres2',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'adres3',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'googleanaltycs',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'googleTagManager',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'facebookPixel',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'chat',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteTitle',
                'value' => config('app.name'),
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteDescription',
                'value' => config('app.name'),
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteKeywords',
                'value' => config('app.name'),
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteAuthor',
                'value' => config('app.name'),
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteAuthor',
                'value' => config('app.name'),
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteLanguage',
                'value' => 'Turkish',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'googleSiteVerification',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'yandexSiteVerification',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'facebookDomainVerification',
                'value' => '',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'googleRobots',
                'value' => 'index,follow',
                'category_id' => 22,
                'isImage' => false

            ],
            [
                'item' => 'siteLogo',
                'value' => '',
                'category_id' => 22,
                'isImage' => true
            ],
            [
                'item' => 'siteMobilLogo',
                'value' => '',
                'category_id' => 22,
                'isImage' => true
            ],
            [
                'item' => 'siteFooterLogo',
                'value' => '',
                'category_id' => 22,
                'isImage' => true
            ],
            [
                'item' => 'siteFavIcon',
                'value' => '',
                'category_id' => 22,
                'isImage' => true
            ]
        ];
    DB::table('settings')->insert($data);
    }
}
