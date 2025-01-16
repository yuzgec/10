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
        $products = Product::lang()->where('status', true)->get();
        
        return view('backend.product.create.simple', compact('cat', 'tags', 'taxClasses', 'attributes', 'products'));
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
            DB::beginTransaction();

            // Ana ürün verilerini hazırla
            $data = $request->validated();
            
            // Kategorileri array'e çevir
            $categories = [];
            if ($request->has('categories')) {
                $categories = is_array($request->categories) ? $request->categories : [$request->categories];
                $categories = array_filter($categories); // Boş değerleri temizle
            }

            // Ürünü oluştur
            $product = $this->productService->create(array_merge(
                $data,
                ['type' => 'simple']
            ));

            // Kategorileri ekle
            if (!empty($categories)) {
                $product->categories()->attach($categories);
            }

            DB::commit();

            alert()->success('Başarılı', 'Ürün başarıyla oluşturuldu.')->persistent(true, false);
            return redirect()->route('product.index');

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata', 'Ürün oluşturulurken bir hata oluştu: ' . $e->getMessage())->persistent(true, false);
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
        $product->load(['translations', 'categories.translations', 'variations.attributes', 'relatedProducts']);
        $cat = ProductCategory::lang()
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        $attributes = ProductAttribute::with('values')->get();
        $products = Product::lang()->where('status', true)->where('id', '!=', $product->id)->get();

        $view = $product->isVariable() ? 'variable' : 'simple';
        
        return view("backend.product.edit.{$view}", compact(
            'product',
            'cat',
            'tags',
            'attributes',
            'products'
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

            // Kategorileri güncelle
            if ($request->has('categories')) {
                $categories = array_map('intval', (array) $request->categories);
                $product->categories()->sync($categories);
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
                'selectedAttributes' => 'nullable|array'
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

    public function show(Product $product)
    {
        $product->load(['translations', 'categories.translations', 'tags', 'relatedProducts']);
        return view('backend.product.show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $excludeId = $request->get('exclude_id');

        $products = Product::query()
            ->select('products.id', 'product_translations.name', 'products.sku')
            ->join('product_translations', function($join) {
                $join->on('products.id', '=', 'product_translations.product_id')
                    ->where('product_translations.locale', '=', app()->getLocale());
            })
            ->when($excludeId, function($q) use ($excludeId) {
                return $q->where('products.id', '!=', $excludeId);
            })
            ->when($query, function ($q) use ($query) {
                $q->where('product_translations.name', 'like', "%{$query}%")
                  ->orWhere('products.sku', 'like', "%{$query}%");
            })
            ->where('products.status', true)
            ->limit(10)
            ->get();

        return response()->json($products);
    }

    public function selected(Request $request)
    {
        $ids = json_decode($request->get('ids'));
        
        if (!$ids) {
            return response()->json([]);
        }

        $products = Product::query()
            ->select('products.id', 'product_translations.name', 'products.sku')
            ->join('product_translations', function($join) {
                $join->on('products.id', '=', 'product_translations.product_id')
                    ->where('product_translations.locale', '=', app()->getLocale());
            })
            ->whereIn('products.id', $ids)
            ->get();

        return response()->json($products);
    }

    public function rules()
    {
        return [
            'name:*' => 'required',
            'slug:*' => 'required',
            'description:*' => 'nullable',
            'short_description:*' => 'nullable',
            'sku' => 'required|unique:products,sku',
            'barcode' => 'nullable|unique:products,barcode',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'categories' => 'required|array|min:1',
            'categories.*' => 'required|exists:product_categories,id',
            'tags' => 'nullable|array',
            'brand_id' => 'nullable|exists:brands,id',
            'tax_status' => 'required|in:taxable,none',
            'tax_class_id' => 'nullable|exists:tax_classes,id',
            'status' => 'boolean',
            'featured' => 'boolean',
            'manage_stock' => 'boolean',
            'min_stock_level' => 'nullable|required_if:manage_stock,true|numeric|min:0',
            'max_stock_level' => 'nullable|required_if:manage_stock,true|numeric|min:0',
            'stock_status' => 'required_if:manage_stock,true',
            'allow_backorders' => 'boolean',
            'notify_low_stock' => 'boolean',
            'low_stock_threshold' => 'nullable|required_if:notify_low_stock,true|numeric|min:0',
            'show_stock_quantity' => 'boolean',
            'requires_shipping' => 'boolean',
            'delivery_time' => 'nullable|required_if:requires_shipping,true',
            'weight' => 'nullable|numeric',
            'dimension_unit' => 'nullable|in:mm,cm,m',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'related_products' => 'nullable|array',
            'related_products.*' => 'exists:products,id'
        ];
    }

    public function messages()
    {
        return [
            'categories.required' => 'En az bir kategori seçmelisiniz.',
            'categories.array' => 'Kategoriler dizi formatında olmalıdır.',
            'categories.min' => 'En az bir kategori seçmelisiniz.',
            'categories.*.exists' => 'Seçilen kategori geçersiz.',
        ];
    }

    public function prepareForValidation()
    {
        // Kategorileri doğru formata çevirelim
        if ($this->has('categories')) {
            $categories = $this->input('categories');
            if (is_string($categories)) {
                $categories = json_decode($categories, true);
            }
            $this->merge([
                'categories' => array_filter(array_map('intval', (array) $categories))
            ]);
        }

        // Boolean değerleri düzenleyelim
        $this->merge([
            'manage_stock' => $this->boolean('manage_stock'),
            'allow_backorders' => $this->boolean('allow_backorders'),
            'notify_low_stock' => $this->boolean('notify_low_stock'),
            'show_stock_quantity' => $this->boolean('show_stock_quantity'),
            'requires_shipping' => $this->boolean('requires_shipping'),
            'status' => $this->boolean('status'),
            'featured' => $this->boolean('featured'),
        ]);
    }
}