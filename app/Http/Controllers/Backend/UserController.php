<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $all = User::with('roles')->get();
        return view('backend.user.index', compact('all'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles);
        }

        alert()->success('Başarılı', 'Kullanıcı başarıyla oluşturuldu');
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('backend.user.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles);
        }

        alert()->success('Başarılı', 'Kullanıcı başarıyla güncellendi');
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('Başarılı', 'Kullanıcı başarıyla silindi');
        return redirect()->route('user.index');
    }
}
