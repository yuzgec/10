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
        $tags = Tag::withType('product')->get();
        return view('backend.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string'
        ]);

        $tag = Tag::create([
            'name' => [
                'tr' => $request->name,
                'en' => $request->name_en ?? $request->name
            ],
            'slug' => [
                'tr' => Str::slug($request->name),
                'en' => Str::slug($request->name_en ?? $request->name)
            ],
            'type' => $request->type
        ]);

        return response()->json($tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back()->with('success', 'Etiket silindi');
    }
} 