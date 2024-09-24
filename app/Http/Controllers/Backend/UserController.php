<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{

    public function index(){
        $all = User::select('id', 'name', 'email')->get();
        return view('backend.user.index',compact('all'));
    }

    public function create(){
        return view('backend.user.create');
    }

    public function show(){

    }

    public function activity(){
        $all = Activity::all();
        return view('backend.user.activity',compact('all'));
    }


    public function store(Request $request){
        $new = new User;
        $new->name = $request->input('name');
        $new->email = $request->input('email');
        $new->password = Hash::make($request->input('password'));
        $new->save();

        return to_route('user.index');
    }

}
