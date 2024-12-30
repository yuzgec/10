<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use App\Models\Category;
use App\Enums\StatusEnum;

use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Services\MediaService;
use App\Services\CategoryService;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use CyrildeWit\EloquentViewable\Support\Period;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ServiceController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //dd(config('settings.telefon1'));

        $cat = $this->categoryService->getChildrenBySlug('hizmet', [],['services']);

        $all = Service::with(['getCategory', 'media'])
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
            Service::class,
            $request->get('period', 'all'),
            $request->get('category_id')
        );

        if ($request->ajax()) {
            return response()->json([
                'chartData' => $chartData
            ]);
        }

        return view('backend.service.index', compact('all', 'cat', 'chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cat = $this->categoryService->getChildrenBySlug('hizmet');
        return view('backend.service.create', compact('cat'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $create = Service::create($request->except('image', 'cover', 'gallery'));

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

        alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli hizmet başarıyla eklendi.', 'success');
        return redirect()->route('service.index');

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
        $edit = Service::with('getCategory')->withTrashed()->find($id);
        $cat = $this->categoryService->getChildrenBySlug('hizmet');
        return view('backend.service.edit', compact('edit', 'cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $update = Service::withTrashed()->find($service->id);

        tap($update)->update($request->except('image', 'cover', 'gallery', 'deleteImage', 'deleteCover'));

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

        alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli hizmet başarıyla güncellendi.', 'success');
        return redirect()->route('service.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Service::findOrFail($id);
        $delete->delete();

        alert()->html('Başarıyla Silindi','Hizmet başarıyla silindi.', 'warning');
        return redirect()->route('service.index');
    }

    public function trash(){
        $all = Service::with(['getCategory'])->onlyTrashed()->paginate(10);
        return view('backend.service.trash',compact('all'));
    }

    public function restore($id){

        $restore = Service::withTrashed()->find($id);
        $restore->restore();

        alert()->html('Başarıyla Geri Alındı','Hizmet başarıyla geri yüklendi.', 'success');
        return redirect()->route('service.index');
    }

    public function sort(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $index => $id) {
            Service::where('id', $id)->update(['rank' => $index + 1]);
        }
        Cache::forget('services');
        return response()->json(['success' => true]);
    }

    public function gallerysort(Request $request)
    {
        //Log::info($request->all());
        $order = $request->input('order'); // Array of media IDs in new order
        foreach ($order as $index => $id) {
            Media::where('id', $id)->update(['order_column' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
