<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SimpleProductRequest;
use App\Http\Requests\Product\VariableProductRequest;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Services\ProductService;
use App\Services\VariationService;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;
use Illuminate\Support\Str;
use App\Models\TaxClass;
use App\Models\ProductAttributeValue;
use App\Models\Language;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;
    protected $variationService;

    public function __construct(ProductService $productService, VariationService $variationService)
    {
        $this->productService = $productService;
        $this->variationService = $variationService;
    }

    public function index()
    {
        $products = Product::withCount('variations')
            ->lang()
            ->latest()
            ->paginate(20);

            //dd($products);

        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        return view('backend.product.create.select-type');
    }

    public function createSimple()
    {
        $cat = ProductCategory::lang()
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        $taxClasses = TaxClass::all();
        $attributes = ProductAttribute::with('values')->get();
        
        return view('backend.product.create.simple', compact('cat', 'tags', 'taxClasses', 'attributes'));
    }

    public function createVariable()
    {
        $cat = ProductCategory::lang()
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        $attributes = ProductAttribute::with('values')->get();
        
        return view('backend.product.create.variable', compact('cat', 'tags', 'attributes'));
    }

    public function storeSimple(SimpleProductRequest $request)
    {
        try {
            $data = $request->validated();
            
            if ($data['tax_status'] === 'none') {
                $data['tax_class_id'] = null;
            }
            
            // Dimension verilerini ekle
            $data = array_merge($data, [
                'weight' => $request->input('weight'),
                'dimension_unit' => $request->input('dimension_unit'),
                'length' => $request->input('length'),
                'width' => $request->input('width'),
                'height' => $request->input('height')
            ]);

            $product = $this->productService->create(array_merge(
                $data,
                ['type' => 'simple']
            ));

            if (!empty($request->selectedAttributes)) {
                foreach ($request->selectedAttributes as $attributeId => $valueId) {
                    if ($valueId) {
                        $product->productAttributes()->create([
                            'attribute_id' => $attributeId,
                            'value_id' => $valueId
                        ]);
                    }
                }
            }

            alert()->success('Başarılı', 'Ürün başarıyla oluşturuldu.')->persistent(true, false);
            return redirect()->route('product.index');

        } catch (\Exception $e) {
            alert()->error('Hata', $e->getMessage())->persistent(true, false);
            \Log::error('Ürün oluşturma hatası: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function storeVariable(VariableProductRequest $request)
    {
        try {
            $product = $this->productService->create(array_merge(
                $request->validated(),
                ['type' => 'variable']
            ));

            if (!empty($request->variations)) {
                $this->variationService->createVariations($product, $request->variations);
            }

            return redirect()
                ->route('product.index')
                ->with('success', 'Ürün başarıyla oluşturuldu.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $product->load(['translations', 'categories.translations', 'variations.attributes']);
        $cat = ProductCategory::lang()
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        $attributes = ProductAttribute::with('values')->get();

        $view = $product->isVariable() ? 'variable' : 'simple';
        
        return view("backend.product.edit.{$view}", compact(
            'product',
            'cat',
            'tags',
            'attributes'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $requestClass = $product->isVariable() 
            ? VariableProductRequest::class 
            : SimpleProductRequest::class;

        $validated = app($requestClass)->validate($request->all());

        try {
            $this->productService->update($product, $validated);

            if ($product->isVariable() && !empty($request->variations)) {
                $product->variations()->delete();
                $this->variationService->createVariations($product, $request->variations);
            }

            return redirect()
                ->route('product.index')
                ->with('success', 'Ürün başarıyla güncellendi.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            $this->productService->delete($product);

            return redirect()
                ->route('product.index')
                ->with('success', 'Ürün başarıyla silindi.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function updateSimple(Request $request, Product $product)
    {
        try {
            $data = $request->validate([
                'name:*' => 'required',
                'slug:*' => 'required',
                'description:*' => 'nullable',
                'short_description:*' => 'nullable',
                'sku' => 'required|unique:products,sku,' . $product->id,
                'barcode' => 'nullable|unique:products,barcode,' . $product->id,
                'stock' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'sale_price' => 'nullable|numeric|min:0',
                'categories' => 'required|array',
                'categories.*' => 'exists:product_categories,id',
                'tags' => 'nullable|array',
                'brand_id' => 'nullable|exists:brands,id',
                'tax_id' => 'nullable|exists:taxes,id',
                'status' => 'required|boolean',
                'featured' => 'required|boolean',
                'weight' => 'nullable|numeric',
                'dimension_unit' => 'nullable|in:mm,cm,m',
                'length' => 'nullable|numeric',
                'width' => 'nullable|numeric',
                'height' => 'nullable|numeric',
                'selectedAttributes' => 'nullable|array',
            ]);

            DB::beginTransaction();

            // Ürünü güncelle
            $this->productService->update($product, $data);

            // Kategorileri güncelle
            $product->categories()->sync($request->input('categories', []));

            // Etiketleri güncelle
            if ($request->has('tags')) {
                $product->tags()->sync($request->input('tags'));
            }

            // Özellikleri güncelle
            if ($request->has('selectedAttributes')) {
                $attributes = [];
                foreach ($request->selectedAttributes as $attributeId => $valueId) {
                    if (!empty($valueId)) {
                        $attributes[$attributeId] = ['value_id' => $valueId];
                    }
                }
                $product->productAttributes()->sync($attributes);
            }

            DB::commit();

            alert()->success('Başarılı', 'Ürün başarıyla güncellendi.')->persistent(true, false);
            return redirect()->route('product.index');

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata', $e->getMessage())->persistent(true, false);
            \Log::error('Ürün güncelleme hatası: ' . $e->getMessage());
            return back()->withInput();
        }
    }
}