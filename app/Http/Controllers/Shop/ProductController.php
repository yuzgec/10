<?php

namespace App\Http\Controllers\Shop;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Enums\ProductTypeEnum;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['translations', 'media', 'categories'])
        ->withCount('variations')
        ->when(request('type'), function($q) {
            $q->where('type', request('type'));
        })
        ->when(request('category'), function($q) {
            $q->whereHas('categories', function($query) {
                $query->where('categories.id', request('category'));
            });
        })
        ->when(request('search'), function($q) {
            $q->whereTranslationLike('name', '%'.request('search').'%');
        })
        ->orderByDesc('created_at')
        ->paginate(20);

        $productTypes = ProductTypeEnum::cases();

        return view('backend.product.index', compact('products', 'productTypes'));

    }

    public function create()
    {
        $attributes = ProductAttribute::all();
        $tags = Tag::all();
        return view('backend.product.create', compact('attributes', 'tags'));
    }


    public function store(Request $request)
    {
        // ... diğer validasyonlar ...

        $product = Product::create($validated);

        // Kategorileri kaydet
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        // Etiketleri kaydet
        if ($request->has('tags')) {
            $product->tags()->sync($request->input('tags'));
        }

        // ... diğer işlemler ...
    }

    public function show(Product $product)
    {
        return view('backend.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('backend.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // ... diğer validasyonlar ...

        $product->update($validated);

        // Kategorileri güncelle
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        // Etiketleri güncelle
        if ($request->has('tags')) {
            $product->tags()->sync($request->input('tags'));
        }

        // ... diğer işlemler ...
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function createVariable()
    {
        $attributes = ProductAttribute::with(['translations'])
            ->where('status', 1)
            ->orderBy('rank')
            ->get()
            ->map(function($attribute) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->translate('tr')->name,
                    'type' => $attribute->type
                ];
            });

        return view('backend.product.variable.create', [
            'attributes' => $attributes->toJson()
        ]);
    }

    public function storeVariable(Request $request)
    {
        $product = Product::create([
            'type' => 2,
            'status' => $request->status,
            'sku' => $request->sku ?? 'go-'.rand(1,1000000),
            'tr' => [
                'name' => $request->input('tr.name'),
                'short' => $request->input('tr.short_description'),
                'desc' => $request->input('tr.description'),
            ],
            'en' => [
                'name' => $request->input('en.name'),
                'short' => $request->input('en.short_description'),
                'desc' => $request->input('en.description'),
            ]
        ]);

        // Kategorileri ekle
        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        // Varyasyonları kaydet
        foreach($request->variations as $variation) {
            $product->variations()->create([
                'sku' => $variation['sku'],
                'price' => $variation['price'],
                'stock' => $variation['stock'],
                'attribute_values' => $variation['values']
            ]);
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Ürün başarıyla kaydedildi.');
    }

    // API endpoint for attribute values
    public function getAttributeValues(ProductAttribute $attribute)
    {
        return response()->json($attribute->values);
    }

    public function editVariable(Product $product)
    {
        // Tüm özellikleri yükle
        $attributes = ProductAttribute::with(['translations', 'values.translations'])
            ->where('status', true)
            ->orderBy('rank')
            ->get()
            ->map(function($attribute) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->translate('tr')->name,
                    'values' => $attribute->values->map(function($value) {
                        return [
                            'id' => $value->id,
                            'name' => $value->translate('tr')->name,
                            'color_code' => $value->color_code
                        ];
                    })
                ];
            });

        // Mevcut varyasyonları yükle
        $variations = $product->variations()
            ->with(['attributeValues.translations', 'attributeValues.attribute'])
            ->orderBy('sort_order')
            ->get()
            ->map(function($variation) {
                return [
                    'id' => $variation->id,
                    'sku' => $variation->sku,
                    'price' => $variation->price,
                    'stock' => $variation->stock,
                    'is_default' => $variation->is_default,
                    'values' => $variation->attributeValues->map(function($value) {
                        return [
                            'attribute_id' => $value->attribute_id,
                            'value_id' => $value->id,
                            'name' => $value->translate('tr')->name
                        ];
                    })
                ];
            });

        return view('backend.product.variable.edit', [
            'product' => $product,
            'attributes' => $attributes,
            'variations' => $variations
        ]);
    }

    public function updateVariable(Request $request, Product $product)
    {
        // validation ve güncelleme işlemleri
    }
} 