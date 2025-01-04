<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    public function index()
    {
        $all = $this->productCategoryService->getAll();
        return view('backend.product.category.index', compact('all'));
    }

    public function create()
    {
        return view('backend.product.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:product_categories,id',
            'status' => 'boolean'
        ]);

        try {
            $this->productCategoryService->create($request->all());
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
        $edit = $this->productCategoryService->getForSelect()
            ->where('id', '!=', $category->id);
        return view('backend.product.category.edit', compact('category', 'edit'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name.*' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:product_categories,id',
            'status' => 'boolean'
        ]);

        try {
            $this->productCategoryService->update($category, $request->all());
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
            $this->productCategoryService->delete($category);
            return redirect()
                ->route('product-categories.index')
                ->with('success', 'Kategori başarıyla silindi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function order(Request $request)
    {
        try {
            $this->productCategoryService->updateOrder($request->items);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
} 