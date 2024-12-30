<?php

namespace App\Http\Controllers\Backend;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $cat = $this->categoryService->getChildrenBySlug('ekip');

        return view('backend.team.create',compact('cat'));
    }

    public function store(TeamRequest $request)
    {
        $create = Team::create($request->except('image', 'cover', 'gallery'));
        $this->mediaService->handleMediaUpload(
            $create, 
            $request->file('image'),
            'page',
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
        $cat = $this->categoryService->getChildrenBySlug('ekip');

        return view('backend.team.edit', compact('edit','cat'));
    }

    public function update(TeamRequest $request, Team $update)
    {
        tap($update)->update($request->except('image', 'cover', 'gallery', 'deleteImage', 'deleteCover'));

        $this->mediaService->updateMedia(
            $update, 
            $request->file('image'),
            'page',
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
