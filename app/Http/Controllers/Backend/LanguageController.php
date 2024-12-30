<?php

namespace App\Http\Controllers\Backend;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class LanguageController extends Controller
{
    public function index()
    {
        $all = Language::paginate(30);
        return view('backend.language.index',compact('all'));
    }

    public function toggle($id)
    {
        try {
            $language = Language::findOrFail($id);
            $language->active = !$language->active;
            $language->save();

            Cache::forget('languages'); // Varsa cache'i temizle
            Artisan::call('cache:clear');
            
            return response()->json([
                'success' => true,
                'message' => 'Dil durumu güncellendi',
                'active' => $language->active
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu'
            ], 500);
        }
    }
}
