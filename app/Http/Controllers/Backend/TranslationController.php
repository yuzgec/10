<?php

namespace App\Http\Controllers\Backend;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationRequest;
use Spatie\TranslationLoader\LanguageLine;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locales = config('laravellocalization.supportedLocales'); 
        $translations = LanguageLine::all();

        return view('backend.translations.index', [
            'locales' => array_keys($locales),
            'all' => $translations,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locales = config('laravellocalization.supportedLocales'); 

        return view('backend.translations.create',['locales' => array_keys($locales)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TranslationRequest $request)
    {
        $request->validate([
            'group' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:language_lines,group',
            'translations' => 'required|array',
            'translations.*' => 'required|string|max:255',
        ]);
    
        // Yeni çeviri ekle
        LanguageLine::create([
            'group' => $request->input('group'),
            'key' => $request->input('key'),
            'text' => $request->input('translations'),
        ]);
    
        return redirect()->route('translation.index')->with('success', 'Translation created successfully!');
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
        $edit = LanguageLine::where('id',$id)->first();
        $a = config('laravellocalization.supportedLocales');
        $locales = array_keys($a);

        return view('backend.translations.edit', compact('edit','locales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TranslationRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
