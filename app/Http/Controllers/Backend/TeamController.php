<?php

namespace App\Http\Controllers\Backend;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TeamController extends Controller
{   


    public function index(Request $request)
    {

        $cat = $this->categoryService->getChildrenBySlug('ekip', [],['teams']);


        $all = Team::with(['getCategory', 'media'])
        ->lang()
        ->when(request('q'), function ($query, $q) {
            $query->whereTranslationLike('name', "%{$q}%")
                  ->orWhereTranslationLike('slug', "%{$q}%")
                  ->orWhereTranslationLike('jobTitle', "%{$q}%")
                  ->orWhereTranslationLike('company', "%{$q}%");
        })
        ->when(request('category_id'), function($query){
            $query->where('category_id', request('category_id'));
        })
        ->rank()
        ->paginate(20);

        $viewService = app(ViewService::class);
        $chartData = $viewService->getViewStats(
            Team::class,
            $request->get('period', 'all'),
            $request->get('category_id')
        );

        if ($request->ajax()) {
            return response()->json([
                'chartData' => $chartData
            ]);
        }

        return view('backend.team.index',compact('all','chartData', 'cat'));
    }

    public function create()
    {
        return view('backend.team.create');
    }

    public function store(TeamRequest $request)
    {
        $create = Team::create($request->except('image', 'cover', 'gallery'));

        if($request->hasfile('image')){
            $create->addMedia($request->image)->toMediaCollection('page');
        }

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $create->addMedia($item)->toMediaCollection('gallery');
            }
        }

        alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli ekip üyesi başarıyla eklendi.', 'success');
        return redirect()->route('team.index');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $edit = Team::withTrashed()->find($id);

        return view('backend.team.edit', compact('edit'));
    }

    public function update(TeamRequest $request, Team $update)
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

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $update->addMedia($item)->toMediaCollection('gallery');
            }
        }

        alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli ekip üyesi başarıyla güncellendi.', 'success');
        return redirect()->route('team.edit', $update->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $delete = Team::findOrFail($id);
        $delete->delete();

        alert()->html('Başarıyla Silindi','Ekip üyesi başarıyla silindi.', 'warning');
        return redirect()->route('team.index');

    }

    public function trash(){
        $all = Team::with(['getCategory'])->onlyTrashed()->paginate(10);
        return view('backend.team.trash',compact('all'));
    }

    public function restore($id){

        $restore = Team::withTrashed()->find($id);
        $restore->restore();

        alert()->html('Başarıyla Geri Alındı','Ekip üyesi başarıyla geri yüklendi.', 'success');
        return redirect()->route('team.index');
    }

    public function sort(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            Team::where('id', $id)->update(['rank' => $index + 1]);
        }

        Cache::forget('teams');

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
