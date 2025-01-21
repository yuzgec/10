<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;

use App\Services\ViewService;
use App\Models\PageTranslation;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Services\MediaService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{   

    public function index(Request $request)
    {

        $cat = $this->categoryService->getChildrenBySlug('sayfa', [],['pages']);

        $all = Page::with(['getCategory', 'media'])
        ->lang()
        ->when(request('q'), function ($query, $q) {
            $query->whereTranslationLike('name', "%{$q}%")
                  ->orWhereTranslationLike('slug', "%{$q}%");
        })
        ->when(request('category_id'), function($query){
            $query->where('category_id', request('category_id'));
        })
        ->rank()
        ->paginate(10);


        $viewService = app(ViewService::class);
        $chartData = $viewService->getViewStats(
            Page::class,
            $request->get('period', 'all'),
            $request->get('category_id')
        );

        if ($request->ajax()) {
            return response()->json([
                'chartData' => $chartData
            ]);
        }

        return view('backend.page.index',compact('all','chartData', 'cat'));
    }

    public function create()
    {
        $cat = $this->categoryService->getChildrenBySlug('sayfa');

        return view('backend.page.create', compact('cat'));
    }

    public function store(PageRequest $request)
    {
        try {
            DB::beginTransaction();

            // Validasyon hatalarını yakalayalım
            if (!$request->validated()) {
                throw new \Exception('Validasyon hatası');
            }

            $create = Page::create($request->except('image', 'cover', 'gallery'));

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

            DB::commit();
            alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli sayfa başarıyla eklendi.', 'success');
            return redirect()->route('page.index');

        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata','Sayfa eklenirken bir hata oluştu: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(string $id)
    {
        $edit = Page::withTrashed()->find($id);
        $cat = $this->categoryService->getChildrenBySlug('sayfa');

        return view('backend.page.edit', compact('edit','cat'));
    }

    public function update(PageRequest $request, Page $update)
    {
        try {
            DB::beginTransaction();

            // Ana sayfa verilerini güncelle
            tap($update)->update($request->except('image', 'cover', 'gallery'));

            // Tekil medya dosyalarını güncelle
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

            // Çoklu medya dosyalarını güncelle
            if ($request->hasFile('gallery')) {
                $files = $request->file('gallery');
                
                $this->mediaService->handleMultipleMediaUpload(
                    $update,
                    $files,
                    'gallery',
                    false
                );
            }

            DB::commit();
            alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli sayfa başarıyla güncellendi.', 'success');
            return redirect()->route('page.edit', $update->id);

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Hata','Sayfa güncellenirken bir hata oluştu: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Page::findOrFail($id);
        $delete->delete();
        alert()->html('Başarıyla Silindi','Sayfa başarıyla silindi.', 'warning');
        return redirect()->route('page.index');
    }

    public function trash(){
        $all = Page::with(['getCategory'])->onlyTrashed()->paginate(10);
        return view('backend.page.trash',compact('all'));
    }

    public function restore($id){

        $restore = Page::withTrashed()->find($id);
        $restore->restore();

        alert()->html('Başarıyla Geri Alındı','Sayfa başarıyla geri yüklendi.', 'success');
        return redirect()->route('page.index');
    }

    public function sort(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            Page::where('id', $id)->update(['rank' => $index + 1]);
        }

        Cache::forget('pages');

        return response()->json(['success' => true, 'message' => 'selam']);
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
