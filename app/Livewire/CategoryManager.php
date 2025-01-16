<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class CategoryManager extends Component
{
    public $selectedCategories = [];
    public $cat;
    public $product;
    public $search = '';

    public function mount($product = null)
    {
        $this->product = $product;
        if ($product) {
            $this->selectedCategories = $product->categories->pluck('id')->toArray();
        }
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $query = ProductCategory::query()->lang();
        
        if ($this->search) {
            $query->whereTranslationLike('name', '%' . $this->search . '%');
        } else {
            $query->whereNull('parent_id');
        }
        
        $this->cat = $query->with(['allChildren', 'parent'])->get();
    }

    public function updatedSearch()
    {
        $this->loadCategories();
    }

    public function selectCategory($categoryId)
    {
        $category = ProductCategory::find($categoryId);
        if (!$category) return;

        if (!in_array($categoryId, $this->selectedCategories)) {
            // Kategori seçildiğinde
            $this->selectedCategories[] = $categoryId;
            
            // Üst kategorileri bul ve ekle
            $parentId = $category->parent_id;
            while ($parentId) {
                if (!in_array($parentId, $this->selectedCategories)) {
                    $this->selectedCategories[] = $parentId;
                }
                $parent = ProductCategory::find($parentId);
                $parentId = $parent ? $parent->parent_id : null;
            }
        } else {
            // Kategori kaldırıldığında
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
            
            // Alt kategorileri bul ve kaldır
            $children = ProductCategory::where('parent_id', $categoryId)->get();
            foreach ($children as $child) {
                $this->selectedCategories = array_diff($this->selectedCategories, [$child->id]);
                $this->removeChildren($child->id);
            }
            
            // Eğer kardeş kategorilerden hiçbiri seçili değilse üst kategoriyi kaldır
            if ($category->parent_id) {
                $siblings = ProductCategory::where('parent_id', $category->parent_id)
                    ->where('id', '!=', $categoryId)
                    ->get();
                
                $hasSelectedSibling = false;
                foreach ($siblings as $sibling) {
                    if (in_array($sibling->id, $this->selectedCategories)) {
                        $hasSelectedSibling = true;
                        break;
                    }
                }
                
                if (!$hasSelectedSibling) {
                    $this->selectedCategories = array_diff($this->selectedCategories, [$category->parent_id]);
                    // Üst kategorinin üst kategorisini kontrol et
                    $parent = ProductCategory::find($category->parent_id);
                    if ($parent && $parent->parent_id) {
                        $this->checkAndRemoveParent($parent);
                    }
                }
            }
        }

        $this->selectedCategories = array_values(array_unique($this->selectedCategories));
        $this->dispatch('selectedCategoriesUpdated', ['selectedCategories' => $this->selectedCategories]);
    }

    private function removeChildren($categoryId)
    {
        $children = ProductCategory::where('parent_id', $categoryId)->get();
        foreach ($children as $child) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$child->id]);
            $this->removeChildren($child->id);
        }
    }

    private function checkAndRemoveParent($category)
    {
        $siblings = ProductCategory::where('parent_id', $category->parent_id)
            ->where('id', '!=', $category->id)
            ->get();
        
        $hasSelectedSibling = false;
        foreach ($siblings as $sibling) {
            if (in_array($sibling->id, $this->selectedCategories)) {
                $hasSelectedSibling = true;
                break;
            }
        }
        
        if (!$hasSelectedSibling) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$category->parent_id]);
            $parent = ProductCategory::find($category->parent_id);
            if ($parent && $parent->parent_id) {
                $this->checkAndRemoveParent($parent);
            }
        }
    }

    public function render()
    {
        return view('livewire.category-manager');
    }
} 