<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\CustomerOffer;
use App\Http\Controllers\Controller;

class CustomerOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = CustomerOffer::withCount(['getCustomer']);

        if ($request->has('name')) {
            $query->where('customer_id', $request->get('customer_id'));
        }

        $all = $query->get();

        //$all = CustomerOffer::with('getCustomer')->get();
        //dd($all); 
        return view('backend.offer.index',compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
}
