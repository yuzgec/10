<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAttributeValueController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductAttributeValue::with(['translations', 'attribute.translations']);
        
        if ($request->has('attribute_id')) {
            $query->where('attribute_id', $request->attribute_id);
        }
        
        $values = $query->orderBy('rank')->paginate(20);
        $attributes = ProductAttribute::with('translations')->get();
        
        return view('backend.product.attribute-value.index', compact('values', 'attributes'));
    }

    public function create()
    {
        $attributes = ProductAttribute::with('translations')
            ->where('status', true)
            ->orderBy('rank')
            ->get();
            
        return view('backend.product.attribute-value.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'attribute_id' => 'required|exists:product_attributes,id',
                'name.*' => 'required|string|max:255',
                'color_code' => 'nullable|string|max:7',
                'rank' => 'nullable|integer|min:0'
            ]);

            DB::beginTransaction();

            $value = ProductAttributeValue::create([
                'attribute_id' => $request->attribute_id,
                'color_code' => $request->color_code ?: null,
                'rank' => $request->rank ?? 0,
                'status' => true
            ]);

            foreach ($request->input('name') as $locale => $name) {
                $value->translateOrNew($locale)->name = $name;
            }

            $value->save();

            DB::commit();

            return redirect()
                ->route('product-attribute-values.index')
                ->with('success', 'Özellik değeri başarıyla oluşturuldu');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Özellik değeri oluşturulurken bir hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function edit(ProductAttributeValue $value)
    {
        $attributes = ProductAttribute::with('translations')
            ->where('status', true)
            ->orderBy('rank')
            ->get();
            
        return view('backend.product.attribute-value.edit', compact('value', 'attributes'));
    }

    public function update(Request $request, ProductAttributeValue $value)
    {
        try {
            $validated = $request->validate([
                'attribute_id' => 'required|exists:product_attributes,id',
                'name.*' => 'required|string|max:255',
                'color_code' => 'nullable|string|max:7',
                'rank' => 'nullable|integer|min:0'
            ]);

            DB::beginTransaction();

            $value->update([
                'attribute_id' => $request->attribute_id,
                'color_code' => $request->color_code ?: null,
                'rank' => $request->rank ?? 0
            ]);

            foreach ($request->input('name') as $locale => $name) {
                $value->translateOrNew($locale)->name = $name;
            }

            $value->save();

            DB::commit();

            return redirect()
                ->route('product-attribute-values.index')
                ->with('success', 'Özellik değeri başarıyla güncellendi');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Özellik değeri güncellenirken bir hata oluştu: ' . $e->getMessage()]);
        }
    }

    public function destroy(ProductAttributeValue $value)
    {
        $value->delete();
        return redirect()
            ->route('product-attribute-values.index')
            ->with('success', 'Özellik değeri başarıyla silindi');
    }

    public function sort(Request $request)
    {
        try {
            $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:product_attribute_values,id',
                'items.*.rank' => 'required|integer|min:1'
            ]);

            DB::beginTransaction();
            
            foreach ($request->items as $item) {
                ProductAttributeValue::where('id', $item['id'])
                    ->update(['rank' => $item['rank']]);
            }
            
            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 