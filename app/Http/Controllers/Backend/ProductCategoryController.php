<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view('backend.product.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categoryService->getForSelect();
        return view('backend.product.category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tr.name' => 'required|string|max:255',
            'en.name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:product_categories,id',
            'status' => 'boolean'
        ]);

        try {
            $this->categoryService->create($request->all());
            return redirect()
                ->route('product-categories.index')
                ->with('success', 'Kategori başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function edit(ProductCategory $category)
    {
        $categories = $this->categoryService->getForSelect()
            ->where('id', '!=', $category->id);
        return view('backend.product.category.edit', compact('category', 'categories'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'tr.name' => 'required|string|max:255',
            'en.name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:product_categories,id',
            'status' => 'boolean'
        ]);

        try {
            $this->categoryService->update($category, $request->all());
            return redirect()
                ->route('product-categories.index')
                ->with('success', 'Kategori başarıyla güncellendi.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function destroy(ProductCategory $category)
    {
        try {
            $this->categoryService->delete($category);
            return redirect()
                ->route('product-categories.index')
                ->with('success', 'Kategori başarıyla silindi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $this->categoryService->updateOrder($request->items);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
} 