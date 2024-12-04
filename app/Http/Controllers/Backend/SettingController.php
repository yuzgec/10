<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::with('getCategory')->get();

        return view('backend.setting.index', compact('settings'));
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