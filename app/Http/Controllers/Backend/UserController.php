<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index(){
        $all = User::select('id', 'name', 'email')->get();
        return view('backend.user.index',compact('all'));
    }

    public function create(){
        $roles = Role::all();

        //dd($roles);
        $permissions = Permission::pluck('name', 'id');
        return view('backend.user.create', compact('roles', 'permissions'));
    }


    public function store(UserRequest $request){

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Yetkileri atama
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);

        }


        alert()->html('Kullanıcı Eklendi','Kullanıcı başarıyla eklendi.', 'success');
        return to_route('user.index');

    }

    public function edit(User $edit)
    {
        $roles = Role::all();
        return view('backend.user.edit', compact('edit', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {

    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password')); // Şifre güncelleme
    }

    $user->save();

    // Rolleri güncelle
    if ($request->has('roles')) {
        $user->syncRoles($request->input('roles')); // Rolleri senkronize et
    }

    alert()->html('Kullanıcı Güncellendi','Kullanıcı başarıyla güncellendi.', 'success');
    return to_route('user.index');
}

    public function assignRole(Request $request, User $user) {
        $user->syncRoles($request->roles);
        return back()->with('success', 'Roller güncellendi.');
    }

    public function assignPermission(Request $request, User $user) {
        $user->syncPermissions($request->permissions);
        return back()->with('success', 'Yetkiler güncellendi.');
    }

    public function activity(){
        $all = Activity::all();
        return view('backend.user.activity',compact('all'));
    }

}
