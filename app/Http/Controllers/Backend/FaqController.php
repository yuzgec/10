<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Faq::with(['getCategory'])->whereHas('translations', function ($query){
            $query->where('name', 'like', '%'.request('q').'%');
        })->paginate(20);
        
        return view('backend.faq.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        $create = Faq::create($request->all());

        alert()->html('Başarıyla Eklendi','<b>'.$create->name.'</b> isimli soru başarıyla eklendi.', 'success');
        return redirect()->route('faq.index');

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
        $edit = Faq::find($id)->firstOrFail();

        return view('backend.faq.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        $update = Faq::find($id);
        tap($update)->update($request->all());

        alert()->html('Başarıyla Güncellendi','<b>'.$update->name.'</b> isimli soru başarıyla güncellendi.', 'success');
        return redirect()->route('faq.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Faq::find($id);
        $delete->delete();

        alert()->html('Başarıyla Silindi','Soru başarıyla silindi.', 'warning');
        return redirect()->route('faq.index');
           
    }
}
