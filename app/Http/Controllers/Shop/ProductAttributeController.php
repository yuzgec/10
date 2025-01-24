<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::with(['translations', 'values'])
            ->orderBy('rank')
            ->paginate(30);

        return view('backend.product.attribute.index', compact('attributes'));
    }

    public function create()
    {
        return view('backend.product.attribute.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name.*' => 'required|string|max:255',
                'status' => 'boolean'
            ]);

            DB::beginTransaction();

            $attribute = ProductAttribute::create([
                'status' => $request->boolean('status', true)
            ]);

            foreach ($request->input('name') as $locale => $name) {
                $attribute->translateOrNew($locale)->name = $name;
            }

            $attribute->save();

            DB::commit();

            return redirect()
                ->route('product-attributes.index')
                ->with('success', 'Özellik başarıyla oluşturuldu');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Özellik oluşturulurken bir hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function show(ProductAttribute $attribute)
    {
        return view('backend.attribute.show', compact('attribute'));
    }

    public function edit(ProductAttribute $attribute)
    {
        return view('backend.product.attribute.edit', compact('attribute'));
    }

    public function update(Request $request, ProductAttribute $attribute)
    {
        try {
            $validated = $request->validate([
                'name.*' => 'required|string|max:255',
                'status' => 'boolean'
            ]);

            DB::beginTransaction();

            $attribute->update([
                'status' => $request->boolean('status', true)
            ]);

            foreach ($request->input('name') as $locale => $name) {
                $attribute->translateOrNew($locale)->name = $name;
            }

            $attribute->save();

            DB::commit();

            return redirect()
                ->route('product-attributes.index')
                ->with('success', 'Özellik başarıyla güncellendi');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Özellik güncellenirken bir hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function destroy(ProductAttribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('product-attributes.index');
    }
} 