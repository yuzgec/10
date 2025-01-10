<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OfferTemplate;
use App\Models\OfferTemplateItem;
use Illuminate\Http\Request;

class OfferTemplateController extends Controller
{
    public function index()
    {
        $templates = OfferTemplate::with('items')->get();
        return view('backend.customer.offer.template.index', compact('templates'));
    }

    public function create()
    {
        return view('backend.customer.offer.template.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency' => 'required|string|max:3',
            'description' => 'nullable|string',
            'terms' => 'nullable|string',
            'notes' => 'nullable|string',
            'is_default' => 'boolean',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string',
            'items.*.unit' => 'required|integer|min:1',
            'items.*.amount' => 'required|numeric|min:0',
            'items.*.discount' => 'required|numeric|min:0|max:100',
            'items.*.tax' => 'required|numeric|min:0|max:100'
        ]);

        // Eğer yeni şablon varsayılan olarak işaretlendiyse diğer varsayılanları kaldır
        if ($request->is_default) {
            OfferTemplate::where('is_default', true)->update(['is_default' => false]);
        }

        $template = OfferTemplate::create($request->except('items'));

        foreach ($request->items as $item) {
            $template->items()->create($item);
        }

        return redirect()->route('offer-templates.index')
            ->with('success', 'Teklif şablonu başarıyla oluşturuldu.');
    }

    public function edit(OfferTemplate $template)
    {
        $template->load('items');
        return view('backend.offer-templates.edit', compact('template'));
    }

    public function update(Request $request, OfferTemplate $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'currency' => 'required|string|max:3',
            'description' => 'nullable|string',
            'terms' => 'nullable|string',
            'notes' => 'nullable|string',
            'is_default' => 'boolean',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string',
            'items.*.unit' => 'required|integer|min:1',
            'items.*.amount' => 'required|numeric|min:0',
            'items.*.discount' => 'required|numeric|min:0|max:100',
            'items.*.tax' => 'required|numeric|min:0|max:100'
        ]);

        // Eğer şablon varsayılan olarak işaretlendiyse diğer varsayılanları kaldır
        if ($request->is_default && !$template->is_default) {
            OfferTemplate::where('is_default', true)->update(['is_default' => false]);
        }

        $template->update($request->except('items'));

        // Mevcut kalemleri sil ve yenilerini ekle
        $template->items()->delete();
        foreach ($request->items as $item) {
            $template->items()->create($item);
        }

        return redirect()->route('offer-templates.index')
            ->with('success', 'Teklif şablonu başarıyla güncellendi.');
    }

    public function destroy(OfferTemplate $template)
    {
        $template->delete();
        return redirect()->route('offer-templates.index')
            ->with('success', 'Teklif şablonu başarıyla silindi.');
    }

    // Şablondan yeni teklif oluştur
    public function createOffer(Request $request, OfferTemplate $template)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id'
        ]);

        $offer = $template->createOffer($request->customer_id);

        return redirect()->route('customer-offers.edit', $offer)
            ->with('success', 'Teklif şablondan başarıyla oluşturuldu.');
    }
} 