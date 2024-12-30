<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use App\Models\Category;
use App\Enums\StatusEnum;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use CyrildeWit\EloquentViewable\Support\Period;
use App\Services\CategoryService;
use App\Services\MediaService;
use App\Services\ViewService;

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
        return view('backend.service.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $create = Service::create($request->except('image', 'cover', 'gallery'));

        if($request->hasfile('image')){
            $create->addMedia($request->image)->toMediaCollection('page');
        }

        if($request->hasfile('cover')){
            $create->addMedia($request->cover)->toMediaCollection('cover');
        }

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $create->addMedia($item)->toMediaCollection('gallery');
            }
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
        $activities = Activity::where('subject_type', ServiceTranslation::class)->where('subject_id', $id)->orderBy('created_at', 'desc')->get();
        return view('backend.service.edit', compact('edit', 'activities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //dd($request->all());
        $update = Service::withTrashed()->find($service->id);

        tap($update)->update($request->except('image', 'cover', 'gallery', 'deleteImage', 'deleteCover'));

        $this->mediaService->updateMedia(
            $service, 
            $request->file('image'),
            $request->input('deleteImage'),
            'page',
            false
        );

        $this->mediaService->updateMedia(
            $service, 
            $request->file('cover'),
            $request->input('deleteCover'),
            'cover',
            true
        );

        // Çoklu medya işlemi (gallery)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $this->mediaService->handleMediaUpload(
                    $service,
                    $file,
                    'gallery',
                    false,
                    true
                );
            }
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
        $order = $request->input('order'); // Array of media IDs in new order

        foreach ($order as $index => $id) {
            Media::where('id', $id)->update(['order_column' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
