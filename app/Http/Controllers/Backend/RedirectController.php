<?php

namespace App\Http\Controllers\Backend;

use App\Models\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    public function index()
    {
        $redirects = Redirect::paginate(20);
        return view('backend.redirect.index', compact('redirects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from_url' => 'required|unique:redirects',
            'to_url' => 'required|different:from_url',
            'status_code' => 'required|in:301,302'
        ]);

        $redirect = Redirect::create($validated);

        // Döngüsel yönlendirme kontrolü
        if ($redirect->hasCircularRedirect()) {
            return back()->with('error', 'Döngüsel yönlendirme tespit edildi!');
        }

        Cache::forget('redirect_' . $redirect->from_url);
        return back()->with('success', 'Yönlendirme başarıyla eklendi.');
    }

    public function destroy(Redirect $redirect)
    {
        Cache::forget('redirect_' . $redirect->from_url);
        $redirect->delete();
        return back()->with('success', 'Yönlendirme silindi.');
    }
} 