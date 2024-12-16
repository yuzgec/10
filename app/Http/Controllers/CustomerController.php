<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Enums\CustomerEnum;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\CustomerWorkType;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $all = Customer::select('id','company_name','phone1','email','status')
        ->withCount(['offers', 'works'])
        ->where('company_name', 'like', '%'. request('q').'%')
        ->orWhere('email', 'like', '%'. request('q').'%')
        ->orWhere('phone1', 'like', '%'. request('q').'%')
        ->paginate(15);
        return view('backend.customer.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {       
         $status = CustomerEnum::cases();
         $type   = CustomerWorkType::all();

        return view('backend.customer.create',compact('status','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
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
        $edit = Customer::find($id);
        $status = CustomerEnum::cases();
        $type   = CustomerWorkType::all();

        //dd($edit);

       return view('backend.customer.edit',compact('edit','status','type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

    public function export() 
    {
        return Excel::download(new UsersExport, now().'customer.xlsx');
    }
}
