<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected function saveProduct($request, $product = null)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            
            // Temel ürün bilgileri
            $product = $product ?? new Product();
            $product->sku = $data['sku'];
            $product->price = $data['price'];
            $product->stock = $data['stock'];
            $product->featured = $data['featured'] ?? false;
            $product->status = $data['status'] ?? false;
            $product->brand_id = $data['brand_id'] ?? null;
            $product->tax_status = $data['tax_status'];
            $product->tax_class_id = $data['tax_class_id'];

            // Stok yönetimi
            $product->manage_stock = $data['manage_stock'] ?? false;
            if ($product->manage_stock) {
                $product->min_stock_level = $data['min_stock_level'];
                $product->stock_status = $data['stock_status'];
                $product->allow_backorders = $data['allow_backorders'] ?? false;
                $product->notify_low_stock = $data['notify_low_stock'] ?? false;
                $product->low_stock_threshold = $data['low_stock_threshold'];
                $product->show_stock_quantity = $data['show_stock_quantity'] ?? false;
            }

            // Kargo & Teslimat
            $product->requires_shipping = $data['requires_shipping'] ?? false;
            if ($product->requires_shipping) {
                $product->delivery_time = $data['delivery_time'];
            }

            // Özel alanlar
            $product->warranty_period = $data['warranty_period'] ?? null;
            $product->manufacturing_place = $data['manufacturing_place'] ?? null;
            $product->barcode = $data['barcode'] ?? null;

            $product->save();

            // Çeviriler
            foreach (config('app.languages', ['tr']) as $lang) {
                $product->translateOrNew($lang)->name = $data["name:$lang"];
                $product->translateOrNew($lang)->slug = $data["slug:$lang"] ?? Str::slug($data["name:$lang"]);
                $product->translateOrNew($lang)->description = $data["description:$lang"] ?? null;
            }
            $product->save();

            // Kategoriler
            if (isset($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }

            // Etiketler
            if (isset($data['tags'])) {
                $product->tags()->sync($data['tags']);
            }

            // Özellikler
            if (isset($data['selectedAttributes'])) {
                $product->attributeValues()->sync($data['selectedAttributes']);
            }

            // İlişkili ürünler
            if (isset($data['related_products'])) {
                $relatedProducts = json_decode($data['related_products']);
                $product->relatedProducts()->sync($relatedProducts);
            }

            // Görseller
            if ($request->hasFile('image')) {
                $product->clearMediaCollection('image');
                $product->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }

            if ($request->hasFile('gallery')) {
                $product->clearMediaCollection('gallery');
                foreach ($request->file('gallery') as $image) {
                    $product->addMedia($image)
                        ->toMediaCollection('gallery');
                }
            }

            DB::commit();
            return $product;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Ürün kaydetme hatası: ' . $e->getMessage());
        }
    }

    public function search()
    {
        $query = request('q');
        
        $products = Product::query()
            ->select('products.id', 'products.sku', 'product_translations.name')
            ->join('product_translations', function($join) {
                $join->on('products.id', '=', 'product_translations.product_id')
                     ->where('product_translations.locale', '=', app()->getLocale());
            })
            ->where(function($q) use ($query) {
                $q->where('product_translations.name', 'like', "%{$query}%")
                  ->orWhere('products.sku', 'like', "%{$query}%");
            })
            ->when(request('exclude_id'), function($q, $id) {
                $q->where('products.id', '!=', $id);
            })
            ->where('products.status', true)
            ->limit(10)
            ->get();

        return response()->json([
            'data' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku
                ];
            })
        ]);
    }

    public function selected()
    {
        $ids = explode(',', request('ids'));
        
        $products = Product::query()
            ->select('products.id', 'products.sku', 'product_translations.name')
            ->join('product_translations', function($join) {
                $join->on('products.id', '=', 'product_translations.product_id')
                     ->where('product_translations.locale', '=', app()->getLocale());
            })
            ->whereIn('products.id', $ids)
            ->get();

        return response()->json([
            'data' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku
                ];
            })
        ]);
    }
} 