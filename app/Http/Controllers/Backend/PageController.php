<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;

use App\Models\PageTranslation;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageController extends Controller
{   

    public function index()
    {
        $all = Page::with(['getCategory','media'])->whereHas('translations', function ($query){
            $query->where('name', 'like', '%'.request('q').'%')->orWhere('slug', 'like', '%'.request('q').'%');
        })->orderBy('rank', 'asc')->paginate(20);

        return view('backend.page.index',compact('all'));
    }

    public function create()
    {
        return view('backend.page.create');
    }

    public function store(PageRequest $request)
    {
        $create = Page::create($request->except('image', 'cover', 'gallery'));

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

        alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli sayfa başarıyla eklendi.', 'success');
        return redirect()->route('page.index');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $edit = Page::withTrashed()->find($id);

        $activities = Activity::where('subject_type', PageTranslation::class)->where('subject_id', $id)->orderBy('created_at', 'desc')->get();

        return view('backend.page.edit', compact('edit','activities'));
    }

    public function update(PageRequest $request, Page $update)
    {
        //$update = Page::find($id);

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

        alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli sayfa başarıyla güncellendi.', 'success');
        return redirect()->route('page.edit', $update->id);

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
