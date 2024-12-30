<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $all = Product::with(['getCategory', 'brand'])
            ->when(request('q'), function($query) {
                $query->whereHas('translations', function($q) {
                    $q->where('name', 'like', '%'.request('q').'%')
                      ->orWhere('slug', 'like', '%'.request('q').'%');
                });
            })
            ->latest()
            ->paginate(20);

        return view('backend.product.index', compact('all'));
    }

    public function create()
    {
        $categories = Category::with('translations')->get();
        $brands = ProductBrand::get();
        return view('backend.product.create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            // Ana ürünü oluştur
            $product = Product::create([
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'status' => $request->status,
                'price' => $request->price,
                'stock' => $request->stock,
                'sku' => $request->sku,
                'has_variants' => $request->boolean('has_variants'),
            ]);

            // Çeviriler için
            foreach(config('translatable.locales') as $locale) {
                $product->translateOrNew($locale)->fill($request->$locale)->save();
            }

            // Varyantları ekle
            if ($request->has_variants && $request->has('variants')) {
                foreach ($request->variants as $variant) {
                    $newVariant = $product->variants()->create([
                        'name' => $variant['name'],
                        'sku' => $variant['sku'],
                        'price' => $variant['price'],
                        'stock' => $variant['stock'],
                        'status' => $variant['status'] ?? true
                    ]);

                    // Varyant resimleri
                    if (isset($variant['images'])) {
                        foreach ($variant['images'] as $image) {
                            $newVariant->addMedia($image)
                                     ->toMediaCollection('variant');
                        }
                    }
                }
            }

            // Ana ürün resimleri
            if ($request->hasFile('image')) {
                $product->addMedia($request->image)
                       ->toMediaCollection('page');
            }

            if ($request->hasFile('cover')) {
                $product->addMedia($request->cover)
                       ->toMediaCollection('cover');
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->gallery as $image) {
                    $product->addMedia($image)
                           ->toMediaCollection('gallery');
                }
            }

            DB::commit();
            return redirect()
                ->route('product.index')
                ->with('success', 'Ürün başarıyla oluşturuldu');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $edit = Product::with(['translations', 'variants.media', 'media'])
                      ->findOrFail($id);
        $categories = Category::with('translations')->get();
        $brands = ProductBrand::with('translations')->get();

        return view('backend.product.edit', compact('edit', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);

            // Ana ürün güncelleme
            $product->update([
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'status' => $request->status,
                'price' => $request->price,
                'stock' => $request->stock,
                'sku' => $request->sku,
                'has_variants' => $request->boolean('has_variants'),
            ]);

            // Çevirileri güncelle
            foreach(config('translatable.locales') as $locale) {
                $product->translateOrNew($locale)->fill($request->$locale)->save();
            }

            // Varyantları güncelle
            if ($request->has_variants && $request->has('variants')) {
                // Mevcut varyantları sil
                $product->variants()->delete();

                // Yeni varyantları ekle
                foreach ($request->variants as $variant) {
                    $newVariant = $product->variants()->create([
                        'name' => $variant['name'],
                        'sku' => $variant['sku'],
                        'price' => $variant['price'],
                        'stock' => $variant['stock'],
                        'status' => $variant['status'] ?? true
                    ]);

                    // Varyant resimleri
                    if (isset($variant['images'])) {
                        foreach ($variant['images'] as $image) {
                            $newVariant->addMedia($image)
                                     ->toMediaCollection('variant');
                        }
                    }
                }
            }

            // Medya güncellemeleri
            if ($request->hasFile('image')) {
                $product->clearMediaCollection('page');
                $product->addMedia($request->image)
                       ->toMediaCollection('page');
            }

            if ($request->hasFile('cover')) {
                $product->clearMediaCollection('cover');
                $product->addMedia($request->cover)
                       ->toMediaCollection('cover');
            }

            if ($request->hasFile('gallery')) {
                $product->clearMediaCollection('gallery');
                foreach ($request->gallery as $image) {
                    $product->addMedia($image)
                           ->toMediaCollection('gallery');
                }
            }

            DB::commit();
            return redirect()
                ->route('product.index')
                ->with('success', 'Ürün başarıyla güncellendi');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ürün başarıyla silindi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    // Medya silme işlemi için
    public function deleteMedia(Request $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            $media = $product->media()->findOrFail($request->media_id);
            $media->delete();

            return response()->json([
                'success' => true,
                'message' => 'Resim başarıyla silindi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu'
            ], 500);
        }
    }
}
