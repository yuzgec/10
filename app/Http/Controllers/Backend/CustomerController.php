<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\Customer;
use App\Models\District;
use App\Enums\CustomerEnum;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\CustomerWorkType;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $all = Customer::withCount(['offers', 'works'])
        ->with(['city', 'district']) // İlişkileri eager loading ile yükle
        ->where('company_name', 'like', '%'. request('q').'%')
        ->orWhere('email1', 'like', '%'. request('q').'%')
        ->orWhere('phone1', 'like', '%'. request('q').'%')
        ->paginate(50);

        $customerStatus = CustomerEnum::cases();

        return view('backend.customer.index', compact('all','customerStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
         $status = CustomerEnum::cases();
         $cities = City::orderBy('name')->get();

        return view('backend.customer.create',compact('status','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        try {
            $customer = Customer::create($request->except(['logo', 'type','selectedTags']));

            // Logo yükleme
            $this->mediaService->handleMediaUpload(
                $customer, 
                $request->file('logo'),
                'page',
                false
            );

            // Etiketleri kaydet
            if ($request->has('selectedTags')) {
                $selectedTags = $request->input('selectedTags');
                if (!empty($selectedTags)) {
                    $customer->tags()->sync($selectedTags);
                }
            }

            alert()->success('Başarılı', 'Müşteri başarıyla eklendi');
            return redirect()->route('customer.index');

        } catch (\Exception $e) {
            alert()->error('Hata', 'Bir hata oluştu: ' . $e->getMessage());
            return back()->withInput();
        }
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
        $edit = Customer::findOrFail($id);
        $status = CustomerEnum::cases();
        $cities = City::orderBy('name')->get();
        return view('backend.customer.edit', compact('edit', 'status','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $customer->update($request->except(['logo', 'type', 'selectedTags']));

            // Logo güncelleme
            if ($request->hasFile('logo')) {
                $customer->clearMediaCollection('logo');
                $customer->addMediaFromRequest('logo')
                    ->toMediaCollection('logo');
            }

            // Etiketleri güncelle
            if ($request->has('selectedTags')) {
                $selectedTags = $request->input('selectedTags');
                if (!empty($selectedTags)) {
                    $customer->tags()->sync($selectedTags);
                } else {
                    $customer->tags()->detach(); // Eğer seçili etiket yoksa hepsini kaldır
                }
            }

            alert()->success('Başarılı', 'Müşteri başarıyla güncellendi');
            return redirect()->route('customer.index');

        } catch (\Exception $e) {
            alert()->error('Hata', 'Bir hata oluştu: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new UsersExport, now().'customer.xlsx');
    }

    public function getDistricts($cityId)
    {
        $districts = District::where('city_id', $cityId)
            ->orderBy('name')
            ->get();
        
        return response()->json($districts);
    }
}
