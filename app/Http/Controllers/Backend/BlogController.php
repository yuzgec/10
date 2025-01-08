<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlogController extends Controller
{   

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cat = $this->categoryService->getChildrenBySlug('blog', [],['blogs']);

        $all = Blog::with(['getCategory', 'media'])
        ->lang()
        ->when(request('q'), function ($query, $q) {
            $query->whereTranslationLike('name', "%{$q}%")
                  ->orWhereTranslationLike('slug', "%{$q}%");
        })
        ->when(request('category_id'), function($query){
            $query->where('category_id', request('category_id'));
        })
        ->rank()
        ->paginate(30);

        $viewService = app(ViewService::class);
        $chartData = $viewService->getViewStats(
            Blog::class,
            $request->get('period', 'all'),
            $request->get('category_id')
        );

        if ($request->ajax()) {
            return response()->json([
                'chartData' => $chartData
            ]);
        }

        return view('backend.blog.index',compact('all','chartData', 'cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cat = $this->categoryService->getChildrenBySlug('blog');

        return view('backend.blog.create', compact('cat'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $create = Blog::create($request->except('image', 'cover', 'gallery'));

        $this->mediaService->handleMediaUpload(
            $create, 
            $request->file('image'),
            'page',
            false
        );

        $this->mediaService->handleMediaUpload(
            $create, 
            $request->file('cover'),
            'cover',
            false
        );

        if ($request->hasFile('gallery')) {
            $files = $request->file('gallery');
            
            $this->mediaService->handleMultipleMediaUpload(
                $create,
                $files,
                'gallery',
            );
        }
        alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli blog başarıyla eklendi.', 'success');
        return redirect()->route('blog.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Blog::withTrashed()->find($id);

        $cat = $this->categoryService->getChildrenBySlug('blog');
        return view('backend.blog.edit', compact('edit','cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Blog $update)
    {
        tap($update)->update($request->except('image', 'cover', 'gallery'));

        $this->mediaService->updateMedia(
            $update, 
            $request->file('image'),
            'page',
            false
        );

        $this->mediaService->updateMedia(
            $update, 
            $request->file('cover'),
            'cover',
            false
        );

        if ($request->hasFile('gallery')) {
            $files = $request->file('gallery');
            
            $this->mediaService->handleMultipleMediaUpload(
                $update,
                $files,
                'gallery',
                false
            );
        }

        alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli blog başarıyla güncellendi.', 'success');
        return redirect()->route('blog.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $delete = Blog::findOrFail($id);
        $delete->delete();

        alert()->html('Başarıyla Silindi','Sayfa başarıyla silindi.', 'warning');
        return redirect()->route('page.index');

    }

    public function trash(){
        $all = Blog::with(['getCategory'])->onlyTrashed()->paginate(10);
        return view('backend.page.trash',compact('all'));
    }

    public function restore($id){

        $restore = Blog::withTrashed()->find($id);
        $restore->restore();

        alert()->html('Başarıyla Geri Alındı','Sayfa başarıyla geri yüklendi.', 'success');
        return redirect()->route('page.index');
    }

    public function sort(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            Blog::where('id', $id)->update(['rank' => $index + 1]);
        }

        Cache::forget('blogs');

        return response()->json(['success' => true]);
    }

    public function gallerysort(Request $request)
    {
        $order = $request->input('order'); // Array of media IDs in new order

        foreach ($order as $index => $id) {
            Media::where('id', $id)->update(['order_column' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}

