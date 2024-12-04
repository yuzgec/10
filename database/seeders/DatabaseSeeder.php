<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\CustomerWork;
use App\Models\ProductBrand;
use App\Models\CustomerOffer;
use Illuminate\Database\Seeder;
use App\Models\CustomerWorkType;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Database\Seeders\SettingSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);

        $arr = ['Web Sitesi', 'Sosyal Medya', 'Logo', 'Baskı', 'Google Maps', 'Google ADS', 'Meta ADS', 'Uzaktan Yardım', 'Satış', 'Kurumsal Mail'];

        foreach($arr as $i){
            $new = new CustomerWorkType;
            $new->name = $i;
            $new->save();
        } 

        $u = User::find(1);
        $u->assignRole('admin');
        $u->givePermissionTo(Role::all());

        CustomerOffer::create(['name' => 'Olcay Yüzgeç', 'customer_id' => 1]);
        CustomerWork::create(['work_name' => 'Firma Web Sitesi', 'customer_id' => 1]);

        Category::create(['name' => 'Sayfa']);
        Category::create(['name' => 'Hizmet']);
        Category::create(['name' => 'Blog']);
        Category::create(['name' => 'Galeri']);
        Category::create(['name' => 'SSS']);
        Category::create(['name' => 'Proje']);
        Category::create(['name' => 'Ürünler']);
        Category::create(['name' => 'Ayarlar']);
        
        Category::create(['name' => 'Kurumsal', 'parent_id' =>1]);
        Category::create(['name' => 'Bilgi', 'parent_id' =>1]);
        Category::create(['name' => 'Belge', 'parent_id' =>1]);
        Category::create(['name' => 'Web Tasarım', 'parent_id' =>2]);
        Category::create(['name' => 'Kurumsal Kimlik', 'parent_id' =>2]);
        Category::create(['name' => 'Google SEO', 'parent_id' =>2]);
        Category::create(['name' => 'Sosyal Medya', 'parent_id' =>2]);
        Category::create(['name' => 'Dijital Reklam', 'parent_id' =>2]);

        Page::create(['name' => 'Kurumsal','category_id' => 9]);


        Service::create(['name' => 'Web Tasarım', 'category_id' => 12]);
        Service::create(['name' => 'Sosyal Medya', 'category_id' => 12]);
        Service::create(['name' => 'Google SEO', 'category_id' => 12]);

        ProductBrand::create(['name' => 'GO Dijital']);

        Category::create(['name' => 'Genel - Blog', 'parent_id' => 3]);
        Category::create(['name' => 'Genel - Galeri', 'parent_id' => 4]);
        Category::create(['name' => 'Genel - SSS', 'parent_id' => 5]);
        Category::create(['name' => 'Genel - Proje', 'parent_id' => 6]);
        Category::create(['name' => 'Tüm Ürünler', 'parent_id' => 7]);
        Category::create(['name' => 'Genel Ayarlar', 'parent_id' => 8]);


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
    Product::factory()->count(2)->create();
    
    $this->call(LanguageSeeder::class);


    }
}
