<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::with(['values'])
            ->lang()
            ->rank()
            ->paginate(20);

        return view('backend.product.attribute.index', compact('attributes'));
    }

    public function create()
    {
        
        return view('backend.product.attribute.create');
    }

    public function store(Request $request)
    {
        try {
            // Ana özellik ve çevirilerini oluştur
            $attribute = ProductAttribute::create($request->except('values', 'colors'));

            // Değerleri ekle
            if (!empty($request->values)) {
                foreach ($request->values as $key => $translations) {
                    $attribute->values()->create([
                        'color_code' => $request->type === 'color' ? ($request->colors[$key] ?? null) : null,
                        'sort_order' => $key,
                        ...$translations
                    ]);
                }
            }

            return redirect()
                ->route('product-attributes.index')
                ->with('success', 'Özellik başarıyla oluşturuldu.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function edit(ProductAttribute $attribute)
    {
        return view('backend.product.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, ProductAttribute $attribute)
    {
        try {
            $attribute->update($request->except('values', 'colors'));
            
            // Mevcut değerleri sil ve yenilerini ekle
            $attribute->values()->delete();
            
            if (!empty($request->values)) {
                foreach ($request->values as $key => $translations) {
                    $attribute->values()->create([
                        'color_code' => $request->type === 'color' ? ($request->colors[$key] ?? null) : null,
                        'sort_order' => $key,
                        ...$translations
                    ]);
                }
            }

            return redirect()
                ->route('product-attributes.index')
                ->with('success', 'Özellik başarıyla güncellendi.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function destroy(ProductAttribute $attribute)
    {
        try {
            $attribute->delete();
            return redirect()
                ->route('product-attributes.index')
                ->with('success', 'Özellik başarıyla silindi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }
} 