<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run()
    {
        $jobTags = [
            'Web Sitesi', 'Sosyal Medya', 'Logo', 'Baskı',
            'Google Maps', 'Google ADS', 'Meta ADS',
            'Uzaktan Yardım', 'Satış', 'Kurumsal Mail'
        ];

        foreach ($jobTags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'type' => 'job',
                'slug' => Str::slug($tagName)
            ]);
        }

        // Örnek ürün etiketleri
        $productTags = ['Yeni', 'İndirimli', 'Öne Çıkan', 'Stokta Yok'];
        foreach ($productTags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'type' => 'product',
                'slug' => Str::slug($tagName)
            ]);
        }

        // Örnek müşteri etiketleri
        $customerTags = ['VIP', 'Aktif', 'Potansiyel', 'Eski Müşteri'];
        foreach ($customerTags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'type' => 'customer',
                'slug' => Str::slug($tagName)
            ]);
        }
    }
} 