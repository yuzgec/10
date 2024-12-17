<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;

use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ServiceController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Service::with(['getCategory'])->whereHas('translations', function ($query){
            $query->where('name', 'like', '%'.request('q').'%')->orWhere('slug', 'like', '%'.request('q').'%');
        })->rank()->paginate(20);
        return view('backend.service.index',compact('all'));
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
    public function update(PageRequest $request, string $id)
    {
        //dd($request->all());
        $update = Service::withTrashed()->find($id);

        tap($update)->update($request->except('image', 'cover', 'gallery', 'deleteImage', 'deleteCover'));


        if($request->deleteImage == "1"){
            $update->media()->where('collection_name', 'page')->delete();
        }

        if($request->hasfile('image')){
            $update->media()->where('collection_name', 'page')->delete();
            $update->addMedia($request->image)->toMediaCollection('page');
        }

        if($request->hasfile('cover')){
            $update->addMedia($request->cover)->toMediaCollection('cover');
        }

        if($request->deleteCover == "1"){
            $update->media()->where('collection_name', 'cover')->delete();
        }

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $update->addMedia($item)->toMediaCollection('gallery');
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
