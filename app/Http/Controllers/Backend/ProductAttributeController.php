<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::with('values')
            ->latest()
            ->paginate(20);

        return view('backend.product.attribute.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend.product.attribute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'type' => 'required|in:select,color,button',
            'values' => 'required|array|min:1',
            'values.*' => 'required|string|max:255',
            'colors.*' => 'required_if:type,color|nullable|string|max:7',
        ]);

        try {
            $attribute = ProductAttribute::create([
                'type' => $request->type
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
                    'sort_order' => $key,
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

    // Edit ve Update metodları benzer şekilde...
} 