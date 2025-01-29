<?php

namespace App\Http\Controllers\Dashboard\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate();
        return view('dashboard.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {

    }
    public function store(Request $request)
    {

    }
    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.edit', [
            'permission' => $permission,
        ]);
    }
    public function update(Request $request, Permission $permission)
    {

    }

    public function action(Request $request)
    {

    }
    public function delete(Permission $permission)
    {
        $delete = $permission->delete();
        if ($delete) {
            return back()->with('status', __('Permission deleted'));
        } else {
            return back()->withErrors([
                'status' => __('Delete Permission failed'),
            ]);
        }
    }

}
