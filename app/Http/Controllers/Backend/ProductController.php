<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

        $all = Product::with(['getCategory'])->whereHas('translations', function ($query){
            $query->where('name', 'like', '%'.request('q').'%')->orWhere('slug', 'like', '%'.request('q').'%');
        })->paginate(10);

        return view('backend.product.index', compact('all'));
    }

    public function create(){
        return view('backend.product.create');
    }

    public function store(Request $request){
        $create = Product::create($request->except('image', 'cover', 'gallery'));

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

        alert()->html('Ürün Başarıyla Eklendi','<b>'.$create->name.'</b> isimli ürün başarıyla eklendi.', 'success');
        return redirect()->route('product.index');
    }

    public function edit($id){
        $edit = Product::withTrashed()->find($id);
        return view('backend.product.edit',compact('edit'));
    }

    public function update(Request $request, $id){

    }
}
