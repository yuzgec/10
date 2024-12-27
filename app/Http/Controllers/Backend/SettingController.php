<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::with('getCategory')->get();

        $iconFiles = File::files(resource_path('views/components/dashboard/icon'));
        $icons = collect($iconFiles)->map(function ($file) {
            return str_replace('.blade.php', '', $file->getFilename());
        });

        return view('backend.setting.index', compact('settings','icons'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item' => 'required|string',
            'value' => 'nullable|string',
            'isImage' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'isType' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image') && $request->isImage) {
            $path = $request->file('image')->store('settings', 'public');
            $validatedData['value'] = $path;
        }

        Setting::create($validatedData);

        return redirect()->route('settings.index')->with('success', 'Setting created successfully.');
    }

    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'value' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image') && $setting->isImage) {
            $path = $request->file('image')->store('settings', 'public');
            $validatedData['value'] = $path;
        }

        $setting->update($validatedData);

        return redirect()->route('settings.index')->with('success', 'Setting updated successfully.');
    }
}