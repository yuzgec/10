<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryManager extends Component
{
    public $selectedCategories = [];
    public $cat;
    public $product;
    public $search = '';
    public $expandedCategories = [];

    public function mount($product = null)
    {
        $this->product = $product;
        if ($product) {
            $this->selectedCategories = $product->categories()
                ->with(['translations', 'children', 'children.translations'])
                ->get()
                ->pluck('id')
                ->toArray();
            
            foreach ($this->selectedCategories as $categoryId) {
                $this->expandParentCategories($categoryId);
            }
        }
        $this->loadCategories();
    }

    private function expandParentCategories($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category && $category->parent_id) {
            $this->expandedCategories[] = $category->parent_id;
            $this->expandParentCategories($category->parent_id);
        }
    }

    public function loadCategories()
    {
        $query = Category::query()
            ->with(['translations', 'children.translations', 'allChildren.translations']);
        
        if ($this->search) {
            $query->whereTranslationLike('name', '%' . $this->search . '%');
        } else {
            $query->whereNull('parent_id');
        }
        
        $this->cat = $query->get();
    }

    public function toggleExpand($categoryId)
    {
        if (in_array($categoryId, $this->expandedCategories)) {
            $this->expandedCategories = array_diff($this->expandedCategories, [$categoryId]);
        } else {
            $this->expandedCategories[] = $categoryId;
        }
        
        // Debug için
        \Log::info('Toggle expand:', [
            'categoryId' => $categoryId,
            'expandedCategories' => $this->expandedCategories
        ]);
    }

    public function selectCategory($categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) return;

        if (!in_array($categoryId, $this->selectedCategories)) {
            // Kategori seçildiğinde
            $this->selectedCategories[] = $categoryId;
            
            // Üst kategorileri otomatik seç
            $this->selectParentCategories($category);
            
            // Alt kategorileri otomatik seç
            $this->selectChildCategories($category);
        } else {
            // Kategori kaldırıldığında
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
            
            // Alt kategorileri otomatik kaldır
            $this->removeChildCategories($category);
        }

        $this->selectedCategories = array_values(array_unique($this->selectedCategories));
        $this->dispatch('selectedCategoriesUpdated', ['selectedCategories' => $this->selectedCategories]);
    }

    private function selectParentCategories($category)
    {
        if ($category->parent_id) {
            $parent = Category::find($category->parent_id);
            if ($parent) {
                $this->selectedCategories[] = $parent->id;
                $this->selectParentCategories($parent);
            }
        }
    }

    private function selectChildCategories($category)
    {
        foreach ($category->children as $child) {
            $this->selectedCategories[] = $child->id;
            $this->selectChildCategories($child);
        }
    }

    private function removeChildCategories($category)
    {
        foreach ($category->children as $child) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$child->id]);
            $this->removeChildCategories($child);
        }
    }

    public function render()
    {
        return view('livewire.category-manager');
    }
} 