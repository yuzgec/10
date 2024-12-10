<?php

namespace App\Http\Controllers\Backend;

use App\Models\Analysis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){

        $analysis = Analysis::all();
        return view('backend.index',compact('analysis'));
    }
}
