<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\ProductService;
use App\Services\MediaService;
use App\Enums\ProductTypeEnum;
use App\Http\Requests\VariableProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with(['brand', 'translations']);

        // Arama
        if ($request->has('q')) {
            $query->whereTranslationLike('name', '%' . $request->q . '%');
        }

        // Marka Filtresi
        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Durum Filtresi
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sıralama
        $query->orderBy($request->get('sort', 'created_at'), $request->get('direction', 'desc'));

        $products = $query->paginate(10)->withQueryString();
        $brands = Brand::all();

        return view('backend.shop.product.index', compact('products', 'brands'));
    }

    public function create()
    {
        $brands = Brand::active()->get();
        $languages = config('app.languages');
        return view('backend.shop.product.create', compact('brands', 'languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:1,2', // 1: Simple, 2: Variable
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'nullable|unique:products,sku',
            'price' => 'required_if:type,1|numeric|min:0',
            'stock' => 'required_if:type,1|integer|min:0',
            'status' => 'boolean',
            'tr.name' => 'required|max:255',
            'tr.slug' => 'required|unique:product_translations,slug',
            'tr.short_description' => 'nullable',
            'tr.description' => 'nullable',
            'tr.seoTitle' => 'nullable|max:255',
            'tr.seoDesc' => 'nullable|max:255',
            'tr.seoKey' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::create([
            'type' => $request->type,
            'brand_id' => $request->brand_id,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'manage_stock' => $request->boolean('manage_stock'),
            'status' => $request->boolean('status'),
        ]);

        // Çeviriler
        foreach (config('app.languages') as $lang) {
            $product->translateOrNew($lang)->fill([
                'name' => $request->input("$lang.name"),
                'slug' => $request->input("$lang.slug"),
                'short_description' => $request->input("$lang.short_description"),
                'description' => $request->input("$lang.description"),
                'seoTitle' => $request->input("$lang.seoTitle"),
                'seoDesc' => $request->input("$lang.seoDesc"),
                'seoKey' => $request->input("$lang.seoKey"),
            ])->save();
        }

        // Ana resim
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        // Galeri
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $product->addMedia($image)
                    ->toMediaCollection('gallery');
            }
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Ürün başarıyla oluşturuldu.');
    }

    public function storeVariable(VariableProductRequest $request)
    {
        DB::beginTransaction();
        
        try {
            $data = $request->validated();
            
            // Temel ürün bilgilerini kaydet
            $product = $this->productService->create([
                'type' => ProductTypeEnum::VARIABLE->value,
                'price' => null, // Değişken ürünler için ana fiyat null olabilir
                'stock' => null, // Değişken ürünler için ana stok null olabilir
                'sku' => $data['sku'] ?? null,
                'status' => $data['status'] ?? true,
                'featured' => $data['featured'] ?? false,
                'brand_id' => $data['brand_id'] ?? null,
            ]);
            
            // Kategorileri ekle
            if (isset($data['categories']) && is_array($data['categories'])) {
                $categories = array_filter($data['categories'], function($value) {
                    return !empty($value) && is_numeric($value);
                });
                
                if (!empty($categories)) {
                    $categories = array_map('intval', $categories);
                    $product->categories()->sync($categories);
                }
            }
            
            // Medya dosyalarını işle
            if ($request->hasFile('image')) {
                $this->mediaService->handleMediaUpload($product, $request->file('image'), 'product');
            }
            
            if ($request->hasFile('gallery')) {
                $this->mediaService->handleMultipleMediaUpload($product, $request->file('gallery'), 'gallery');
            }
            
            DB::commit();
            return redirect()->route('product.edit', $product->id)->with('success', 'Ürün başarıyla oluşturuldu. Şimdi varyantları ekleyebilirsiniz.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Varyasyonlu ürün oluşturma hatası: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Ürün oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function updateVariable(VariableProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        
        try {
            $data = $request->validated();
            
            // Temel ürün bilgilerini güncelle
            $product->update([
                'sku' => $data['sku'] ?? null,
                'status' => $data['status'] ?? true,
                'featured' => $data['featured'] ?? false,
                'brand_id' => $data['brand_id'] ?? null,
            ]);
            
            // Kategorileri güncelle
            if (isset($data['categories']) && is_array($data['categories'])) {
                $categories = array_filter($data['categories'], function($value) {
                    return !empty($value) && is_numeric($value);
                });
                
                if (!empty($categories)) {
                    $categories = array_map('intval', $categories);
                    $product->categories()->sync($categories);
                }
            }
            
            // Medya dosyalarını işle
            if ($request->hasFile('image')) {
                $this->mediaService->handleMediaUpload($product, $request->file('image'), 'product');
            }
            
            if ($request->hasFile('gallery')) {
                $this->mediaService->handleMultipleMediaUpload($product, $request->file('gallery'), 'gallery');
            }
            
            DB::commit();
            return redirect()->route('product.edit', $product->id)->with('success', 'Ürün başarıyla güncellendi.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Varyasyonlu ürün güncelleme hatası: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Ürün güncellenirken bir hata oluştu: ' . $e->getMessage());
        }
    }
} 