<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductVariantController extends Controller
{
    public function index($product_id)
    {
        $product = Product::with(['variants.translations'])->findOrFail($product_id);
        return view('backend.product.variant.index', compact('product'));
    }

    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('backend.product.variant.create', compact('product'));
    }

    public function store(Request $request, $product_id)
    {
        $request->validate([
            'name.*' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|unique:product_variants,sku'
        ]);

        $variant = new ProductVariant();
        $variant->product_id = $product_id;
        $variant->price = $request->price;
        $variant->stock = $request->stock;
        $variant->sku = $request->sku;
        $variant->status = $request->status ? 1 : 0;
        $variant->save();

        // Çeviriler için
        foreach ($request->name as $locale => $name) {
            $variant->translateOrNew($locale)->name = $name;
        }
        $variant->save();

        Cache::forget('product_variants');
        
        alert()->success('Başarılı', 'Varyant başarıyla oluşturuldu.');
        return redirect()->route('product.variant.index', $product_id);
    }

    public function edit($product_id, $id)
    {
        $product = Product::findOrFail($product_id);
        $variant = ProductVariant::with('translations')->findOrFail($id);
        return view('backend.product.variant.edit', compact('product', 'variant'));
    }

    public function update(Request $request, $product_id, $id)
    {
        $request->validate([
            'name.*' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|unique:product_variants,sku,' . $id
        ]);

        $variant = ProductVariant::findOrFail($id);
        $variant->price = $request->price;
        $variant->stock = $request->stock;
        $variant->sku = $request->sku;
        $variant->status = $request->status ? 1 : 0;
        $variant->save();

        // Çeviriler için
        foreach ($request->name as $locale => $name) {
            $variant->translateOrNew($locale)->name = $name;
        }
        $variant->save();

        Cache::forget('product_variants');

        alert()->success('Başarılı', 'Varyant başarıyla güncellendi.');
        return redirect()->route('product.variant.index', $product_id);
    }

    public function destroy($product_id, $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();

        Cache::forget('product_variants');

        alert()->success('Başarılı', 'Varyant başarıyla silindi.');
        return redirect()->route('product.variant.index', $product_id);
    }

    public function sort(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $index => $id) {
            ProductVariant::where('id', $id)->update(['rank' => $index + 1]);
        }
        Cache::forget('product_variants');
        return response()->json(['success' => true]);
    }
} 