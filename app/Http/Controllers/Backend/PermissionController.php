<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('backend.user.permission.index', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create(['name' => $request->name]);

        alert()->success('Başarılı', 'Yetki başarıyla oluşturuldu');
        return back();
    }

    public function assignPermission(Request $request)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'permissions' => 'nullable|array',
        ]);

        try {
            $role = Role::findByName($request->role);
            
            // Eğer permissions boşsa, tüm yetkileri kaldır
            if (empty($request->permissions)) {
                $role->syncPermissions([]);
            } else {
                // Permission ID'lerini al ve Permission modellerini bul
                $permissions = Permission::whereIn('id', $request->permissions)->get();
                $role->syncPermissions($permissions);
            }

            alert()->success('Başarılı', 'Yetkiler başarıyla atandı');
        } catch (\Exception $e) {
            alert()->error('Hata', 'Yetkiler atanırken bir hata oluştu: ' . $e->getMessage());
        }

        return back();
    }

    public function getRolePermissions($roleName)
    {
        try {
            $role = Role::where('name', $roleName)->firstOrFail();
            return response()->json([
                'success' => true,
                'permissions' => $role->permissions->pluck('id')->toArray()
            ]);
        } catch (\Exception $e) {
            \Log::error('Rol yetkileri alınırken hata: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Rol yetkileri alınırken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        alert()->success('Başarılı', 'Yetki başarıyla silindi');
        return back();
    }
} 