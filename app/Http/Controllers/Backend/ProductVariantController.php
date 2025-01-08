<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

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
            'sku' => 'required|unique:product_variations'
        ]);

        $variant = ProductVariant::create([
            'product_id' => $product_id,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ? 1 : 0
        ]);

        // Çeviriler
        foreach (config('app.languages') as $locale) {
            $variant->translateOrNew($locale)->name = $request->name[$locale];
            $variant->translateOrNew($locale)->slug = Str::slug($request->name[$locale]);
        }
        $variant->save();

        // Variation key oluştur
        $this->variationService->generateVariationKey($variant);

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
            'sku' => 'required|unique:product_variations,sku,' . $id
        ]);

        $variant = ProductVariant::findOrFail($id);
        
        $variant->update([
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status ? 1 : 0
        ]);

        // Çeviriler
        foreach (config('app.languages') as $locale) {
            $variant->translateOrNew($locale)->name = $request->name[$locale];
            $variant->translateOrNew($locale)->slug = Str::slug($request->name[$locale]);
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