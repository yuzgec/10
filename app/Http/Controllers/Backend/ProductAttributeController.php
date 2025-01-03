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
        $attributes = ProductAttribute::with('translations', 'values')
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:select,color,button',
            'values' => 'required|array|min:1',
            'values.*' => 'required|string|max:255',
            'colors.*' => 'required_if:type,color|nullable|string|max:7',
        ]);

        try {
            $attribute = ProductAttribute::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'type' => $validated['type'],
            ]);

            foreach ($validated['values'] as $key => $value) {
                $attribute->values()->create([
                    'value' => $value,
                    'slug' => Str::slug($value),
                    'color_code' => $validated['colors'][$key] ?? null,
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