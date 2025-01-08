<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withType('product')
            ->withCount('products')
            ->get();
        return view('backend.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        try {
            $tag = Tag::create([
                'name' => $request->name,
                'type' => $request->type ?? 'product'
            ]);

            return response()->json([
                'success' => true,
                'id' => $tag->id,
                'name' => $tag->name
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->back()->with('success', 'Etiket başarıyla silindi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Etiket silinirken bir hata oluştu');
        }
    }

    public function products(Tag $tag)
    {
        $products = $tag->products()->paginate(20);
        return view('backend.tags.products', compact('tag', 'products'));
    }
} 