<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::with('translations', 'values')->paginate(20);
        return view('backend.product.attribute.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend.product.attribute.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name.*' => 'required|string|max:255',
                'type' => 'required|in:select,color,size',
                'values' => 'required|array|min:1',
                'values.*' => 'required|string|max:255',
                'colors' => 'required_if:type,color|array',
                'colors.*' => 'required_if:type,color|string|max:7'
            ]);

            $attribute = ProductAttribute::create([
                'type' => $request->type,
                'is_filterable' => $request->has('is_filterable'),
                'is_required' => $request->has('is_required')
            ]);

            // Çeviriler
            foreach ($request->name as $locale => $name) {
                $attribute->translations()->create([
                    'locale' => $locale,
                    'name' => $name,
                    'slug' => Str::slug($name)
                ]);
            }

            // Değerler
            foreach ($request->values as $key => $value) {
                $attribute->values()->create([
                    'value' => $value,
                    'slug' => Str::slug($value),
                    'color_code' => $request->type === 'color' ? $request->colors[$key] : null,
                    'sort_order' => $key
                ]);
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
        $attribute->load('translations', 'values');
        return view('backend.product.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, ProductAttribute $attribute)
    {
        try {
            $request->validate([
                'name.*' => 'required|string|max:255',
                'type' => 'required|in:select,color,size',
                'values' => 'required|array|min:1',
                'values.*' => 'required|string|max:255',
                'colors' => 'required_if:type,color|array',
                'colors.*' => 'required_if:type,color|string|max:7'
            ]);

            $attribute->update([
                'type' => $request->type,
                'is_filterable' => $request->has('is_filterable'),
                'is_required' => $request->has('is_required')
            ]);

            // Çevirileri güncelle
            foreach ($request->name as $locale => $name) {
                $attribute->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'name' => $name,
                        'slug' => Str::slug($name)
                    ]
                );
            }

            // Mevcut değerleri sil
            $attribute->values()->delete();

            // Yeni değerleri ekle
            foreach ($request->values as $key => $value) {
                $attribute->values()->create([
                    'value' => $value,
                    'slug' => Str::slug($value),
                    'color_code' => $request->type === 'color' ? $request->colors[$key] : null,
                    'sort_order' => $key
                ]);
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
            // İlişkili çeviriler ve değerler otomatik silinecek (cascade)
            $attribute->delete();

            return redirect()
                ->route('product-attributes.index')
                ->with('success', 'Özellik başarıyla silindi.');

        } catch (\Exception $e) {
            return back()->with('error', 'Silme işlemi başarısız: ' . $e->getMessage());
        }
    }
} 