<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getChildrenBySlug(string $slug, array $with = [], array $withCount = []): Collection
    {
        $parentCategory = Category::whereTranslation('slug', $slug, app()->getLocale())->first();

        $query = Category::query();

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
        return Category::whereTranslation('slug', $slug, app()->getLocale())->first();
    }
} 