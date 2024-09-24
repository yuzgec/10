<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),  // Ürün ismi, 3 kelimelik bir cümle olarak
            'short' => $this->faker->sentence(2),  // Kısa açıklama
            'desc' => $this->faker->sentence(2),  // Uzun açıklama, 3 paragraflık metin
            'seoTitle' => $this->faker->sentence(2),  // SEO başlığı
            'seoDesc' => $this->faker->sentence(2),  // SEO açıklaması
            'seoKey' => $this->faker->words(1, true),  // SEO anahtar kelimeler
            'addGoogle' => $this->faker->boolean(),  // Google Analytics eklensin mi
            'addComment' => $this->faker->boolean(),  // Yorumlar açık mı
            'deleteContent' => $this->faker->boolean(),  // İçerik silinsin mi
            'searchText' => $this->faker->paragraph(),  // Arama metni
            'category_id' => 7,  // Kategori ID (genellikle factory üzerinden çekilir)
            'brand_id' => 1,  // Marka ID'si
            'price' => $this->faker->randomFloat(2, 10, 1000),  // Ürün fiyatı, 10 ile 1000 arasında rastgele
            'stock' => $this->faker->numberBetween(0, 100),  // Stok sayısı
            'sku' => $this->faker->unique()->numerify('SKU-####'),  // Benzersiz SKU
            'rank' => $this->faker->optional()->numberBetween(1, 100)  // Sıralama, rastgele bir sayı veya null
        ];
    }
}
