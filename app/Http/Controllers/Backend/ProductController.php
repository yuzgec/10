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
        $products = Product::with(['variations'])
            ->withCount('variations')
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
        $categories = ProductCategory::with('translations')
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        
        return view('backend.product.create.simple', compact('categories', 'tags'));
    }

    public function createVariable()
    {
        $categories = ProductCategory::with('translations')
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        $attributes = ProductAttribute::with('values')->get();
        
        return view('backend.product.create.variable', compact('categories', 'tags', 'attributes'));
    }

    public function storeSimple(SimpleProductRequest $request)
    {
        try {
            $product = $this->productService->create(array_merge(
                $request->validated(),
                ['type' => 'simple']
            ));

            alert()->html('Başarıyla Eklendi','<b>'.$product->name.'</b> isimli ürün başarıyla eklendi.', 'success');
            return redirect() ->route('product.index');

        } catch (\Exception $e) {

            alert()->html('HATA',$e->getMessage(), 'error');
            return redirect()->back();

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
        $categories = ProductCategory::with('translations')
            ->where('status', true)
            ->orderBy('rank')
            ->get();
        $tags = Tag::all();
        $attributes = ProductAttribute::with('values')->get();

        $view = $product->isVariable() ? 'variable' : 'simple';
        
        return view("backend.product.edit.{$view}", compact(
            'product',
            'categories',
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
}