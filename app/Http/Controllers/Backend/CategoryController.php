<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function indexAll(){
        return view('backend.category.indexAll');
    }
    
    public function index()
    {
        $all = $this->categoryService->getChildrenBySlug(request('q'));
        //dd($all);
        return view('backend.category.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $create = Category::create($request->all());

        if($request->hasfile('image')){
            $create->addMedia($request->image)->toMediaCollection('page');
        }

        if($request->hasfile('cover')){
            $create->addMedia($request->cover)->toMediaCollection('cover');
        }

        if ($request->parent_id){
            $node = Category::find($request->parent_id);
            $node->appendNode($create);
        }

        alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli kategori başarıyla eklendi.', 'success');
        return redirect()->route('category.indexAll');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $edit = Category::withTrashed()->find($id);

        return view('backend.category.edit',compact('edit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Category::find($id);

        $parent = Category::ancestorsOf($id);

        //dd($edit->parent_id,$parent);

        return view('backend.category.edit',compact('edit','parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $update)
    {

        if ($request->parent_id && $update->id == $request->parent_id) {
            return back()->withErrors(['error' => 'Bir node kendisinin altına taşınamaz.']);
        }

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

        if ($request->parent_id){
            $node = Category::find($request->parent_id);
            $node->appendNode($update);
        }

        alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli sayfa başarıyla güncellendi.', 'success');
        return redirect()->route('category.edit', $update->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
