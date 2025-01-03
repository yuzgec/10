<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'translations' => [
                    'tr' => [
                        'name' => 'Elektronik',
                        'slug' => 'elektronik',
                        'desc' => 'Elektronik ürünler kategorisi'
                    ],
                    'en' => [
                        'name' => 'Electronics',
                        'slug' => 'electronics',
                        'desc' => 'Electronics products category'
                    ]
                ],
                'children' => [
                    [
                        'translations' => [
                            'tr' => [
                                'name' => 'Telefonlar',
                                'slug' => 'telefonlar'
                            ],
                            'en' => [
                                'name' => 'Phones',
                                'slug' => 'phones'
                            ]
                        ]
                    ],
                    [
                        'translations' => [
                            'tr' => [
                                'name' => 'Bilgisayarlar',
                                'slug' => 'bilgisayarlar'
                            ],
                            'en' => [
                                'name' => 'Computers',
                                'slug' => 'computers'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($categories as $categoryData) {
            $this->createCategory($categoryData);
        }
    }

    private function createCategory($data, $parentId = null)
    {
        $translations = $data['translations'];
        unset($data['translations']);
        
        $children = $data['children'] ?? [];
        unset($data['children']);

        $category = ProductCategory::create(array_merge(
            $data,
            ['parent_id' => $parentId]
        ));

        foreach ($translations as $locale => $translation) {
            $category->translateOrNew($locale)->fill($translation)->save();
        }

        foreach ($children as $child) {
            $this->createCategory($child, $category->id);
        }

        return $category;
    }
} 