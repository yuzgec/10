<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function getAll()
    {
        return ProductCategory::with('translations')
            ->withCount([
                'products'
            ])
            ->orderBy('rank')
            ->get();
    }

    public function getChildrenBySlug(string $slug, array $with = [], array $withCount = []): Collection
    {
        $parentCategory = ProductCategory::whereTranslation('slug', $slug, app()->getLocale())->first();

        $query = ProductCategory::query();

        if (!empty($with)) {
            $query->with($with);
        }

        if (!empty($withCount)) {
            $query->withCount($withCount);
        }

        return $query->where('parent_id', $parentCategory?->id)->get();
    }

    public function getParentBySlug(string $slug): ?Category
    {
        return ProductCategory::whereTranslation('slug', $slug, app()->getLocale())->first();
    }
} 