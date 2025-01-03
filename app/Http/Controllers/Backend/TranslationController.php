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
        $all = LanguageLine::all();

        return view('backend.translations.create',compact('all'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TranslationRequest $request)
    {
        $request->validate([
            'group' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:language_lines,key',
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

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $edit = LanguageLine::findOrFail($id);
        $locales = config('laravellocalization.supportedLocales');

        return view('backend.translations.edit', [
            'locales' => array_keys($locales),
            'edit' => $edit
        ]);
    }

    public function update(TranslationRequest $request, string $id)
    {
        try {
            $translation = LanguageLine::findOrFail($id);
            
            $translation->update([
                'group' => $request->input('group'),
                'key' => $request->input('key'),
                'text' => $request->input('translations'),
            ]);

            alert()->html('Başarıyla Güncellendi', 'Çeviri başarıyla güncellendi.', 'success');
            return redirect()->route('translation.index');

        } catch (\Exception $e) {

            alert()->html('HATA', $e->getMessage(), 'error');

            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
