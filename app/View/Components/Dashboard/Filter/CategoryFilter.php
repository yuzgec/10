<?php

namespace App\View\Components\Dashboard\Filter;

use Illuminate\View\Component;
use App\Models\Category;

class CategoryFilter extends Component
{
    public $categories;
    public $selectedId;

    public function __construct($slug)
    {
        $parent = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();
        
        if ($parent) {
            $this->categories = Category::where('parent_id', $parent->id)
                ->defaultOrder()
                ->get();
        }
        
        $this->selectedId = request('category_id', 0);
    }

    public function render()
    {
        return view('components.dashboard.filter.category-filter');
    }
} 