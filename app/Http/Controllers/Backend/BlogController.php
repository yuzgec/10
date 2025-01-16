<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\DB;
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
    public function store(BlogRequest $request)
    {
        try {
            DB::beginTransaction();

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
                $this->mediaService->handleMultipleMediaUpload(
                    $create,
                    $request->file('gallery'),
                    'gallery'
                );
            }

            DB::commit();
            alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli blog başarıyla eklendi.', 'success');
            return redirect()->route('blog.index');

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata','Blog eklenirken bir hata oluştu: ' . $e->getMessage());
            return back();
        }
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
    public function update(BlogRequest $request, Blog $update)
    {
        try {
            DB::beginTransaction();

            $update->update($request->except('image', 'cover', 'gallery'));

            $this->mediaService->handleMediaUpload(
                $update, 
                $request->file('image'),
                'page',
                false
            );

            $this->mediaService->handleMediaUpload(
                $update, 
                $request->file('cover'),
                'cover',
                false
            );

            if ($request->hasFile('gallery')) {
                $this->mediaService->handleMultipleMediaUpload(
                    $update,
                    $request->file('gallery'),
                    'gallery'
                );
            }

            DB::commit();
            alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli blog başarıyla güncellendi.', 'success');
            return redirect()->route('blog.index');

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata','Blog güncellenirken bir hata oluştu: ' . $e->getMessage());
            return back();
        }
    }

    public function trash(){
        $all = Blog::with(['getCategory'])->onlyTrashed()->paginate(10);
        return view('backend.page.trash',compact('all'));
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Blog $destroy)
{
    try {
        DB::beginTransaction();

        // Sadece softDelete yap, medya dosyalarını silme
        $destroy->delete();

        DB::commit();
        alert()->html('Başarıyla Silindi','<b>'.$destroy->name.'</b> isimli blog başarıyla silindi.', 'success');
        return redirect()->route('blog.index');

    } catch (\Exception $e) {
        DB::rollBack();
        alert()->error('Hata','Blog silinirken bir hata oluştu: ' . $e->getMessage());
        return back();
    }
}

// Eğer gerçekten silmek istersek (forceDelete) ayrı bir metod ekleyebiliriz
public function forceDestroy(Blog $blog)
{
    try {
        DB::beginTransaction();

        // Önce medya dosyalarını sil
        $blog->clearMediaCollection('page');
        $blog->clearMediaCollection('cover');
        $blog->clearMediaCollection('gallery');

        // Sonra kaydı tamamen sil
        $blog->forceDelete();

        DB::commit();
        alert()->html('Kalıcı Olarak Silindi','<b>'.$blog->name.'</b> isimli blog kalıcı olarak silindi.', 'success');
        return redirect()->route('blog.index');

    } catch (\Exception $e) {
        DB::rollBack();
        alert()->error('Hata','Blog kalıcı olarak silinirken bir hata oluştu: ' . $e->getMessage());
        return back();
    }
}

// Geri yükleme metodu
    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $blog = Blog::withTrashed()->findOrFail($id);
            $blog->restore();

            DB::commit();
            alert()->html('Başarıyla Geri Yüklendi','<b>'.$blog->name.'</b> isimli blog başarıyla geri yüklendi.', 'success');
            return redirect()->route('blog.index');

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata','Blog geri yüklenirken bir hata oluştu: ' . $e->getMessage());
            return back();
        }
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

