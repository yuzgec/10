<?php

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryService
{
    public function getAll()
    {
        return ProductCategory::with('translations')
            ->withCount(['products', 'children'])
            ->orderBy('rank')
            ->get();
    }

    public function create(array $data)
    {
        $category = ProductCategory::create([
            'parent_id' => $data['parent_id'] ?? null,
            'rank' => $data['rank'] ?? 0,
            'status' => $data['status'] ?? true
        ]);

        // Çeviriler
        foreach (config('app.locales') as $locale) {
            $category->translateOrNew($locale)->fill([
                'name' => $data["name:$locale"],
                'slug' => Str::slug($data["name:$locale"]),
                'short' => $data["short:$locale"] ?? null,
                'desc' => $data["desc:$locale"] ?? null,
                'seoTitle' => $data["seoTitle:$locale"] ?? null,
                'seoDesc' => $data["seoDesc:$locale"] ?? null,
                'seoKey' => $data["seoKey:$locale"] ?? null,
            ])->save();
        }

        // Medya
        if (!empty($data['image'])) {
            $category->addMedia($data['image'])
                ->toMediaCollection('image');
        }

        return $category;
    }

    public function update(ProductCategory $category, array $data)
    {
        $category->update([
            'parent_id' => $data['parent_id'] ?? null,
            'rank' => $data['rank'] ?? 0,
            'status' => $data['status'] ?? true
        ]);

        // Çeviriler güncelleme
        foreach (config('app.locales') as $locale) {
            $category->translateOrNew($locale)->fill([
                'name' => $data["name:$locale"],
                'slug' => Str::slug($data["name:$locale"]),
                'short' => $data["short:$locale"] ?? null,
                'desc' => $data["desc:$locale"] ?? null,
                'seoTitle' => $data["seoTitle:$locale"] ?? null,
                'seoDesc' => $data["seoDesc:$locale"] ?? null,
                'seoKey' => $data["seoKey:$locale"] ?? null,
            ])->save();
        }

        // Medya güncelleme
        if (!empty($data['image'])) {
            $category->clearMediaCollection('image');
            $category->addMedia($data['image'])
                ->toMediaCollection('image');
        }

        return $category;
    }

    public function delete(ProductCategory $category)
    {
        // Alt kategorileri kontrol et
        if ($category->children()->exists()) {
            throw new \Exception('Alt kategorileri olan bir kategori silinemez.');
        }

        // İlişkili ürünleri kontrol et
        if ($category->products()->exists()) {
            throw new \Exception('Ürünleri olan bir kategori silinemez.');
        }

        $category->delete();
        return true;
    }

    public function getForSelect()
    {
        return ProductCategory::with('translations')
            ->active()
            ->orderBy('rank')
            ->get();
    }

    public function updateOrder(array $items, $parentId = null)
    {
        foreach ($items as $index => $item) {
            $category = ProductCategory::find($item['id']);
            if ($category) {
                $category->update([
                    'parent_id' => $parentId,
                    'rank' => $index + 1
                ]);

                if (isset($item['children'])) {
                    $this->updateOrder($item['children'], $item['id']);
                }
            }
        }
    }
} 