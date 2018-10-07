<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Permission;
use App\Article;

class UserController extends BaseController
{

    public function __construct()
    {
        $this->middleware('acl:user.manage');
    }

    public function index(Request $request)
    {
        $s = $request->s ? $request->s : '';

        $users = User::with('roles')
                    ->whereUser($s)
                    ->latest()
                    ->paginate(10);
        $roles = Role::orderBy('id', 'ASC')->get(['id', 'name']);
        return view('admin.users.index', compact('users', 'roles', 's'));
    }

    public function destroy($id)
    {
        if($id == 1){
            return response()->json(['status' => 401, 'msg' => 'Cannot delete super administrator']);
        }
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['status' => 404, 'msg' => 'User Does not Exist']);
        }
        $articles = Article::whereUserId($id)->count();
        if($articles > 0){
            return response()->json(['status' => 403, 'msg' => 'Please delete the user article first']);
        }
        $user->delete();
        return response()->json(['status' => 200, 'msg' => 'Successfully Deleted']);
    }

    public function changeRole(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        if($user_id == 1){
            return response()->json(['status' => 401, 'msg' => 'Cannot modify the super administrators user group']);
        }
        $user = User::find($user_id, ['id']);
        $role = Role::find($role_id, ['id']);
        if (empty($user) || empty($role)) {
            return response()->json(['status' => 404, 'msg' => 'User or user group does not exist']);
        }
        $user->assignRole($role->id);

        $roles = Role::orderBy('id', 'DESC')->get(['id', 'name']);
        $html = view()->make('admin.users._user_roles', compact('roles', 'user'))->render();
        return response()->json(['status' => 200, 'html' => $html]);
    }

    public function roles()
    {
        $roles = Role::with('permissions')->orderBy('id', 'DESC')->get();
        return view('admin.users.roles', compact('roles'));
    }

    public function editRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::get(['id', 'name']);
        return view('admin.users.editrole', compact('role', 'permissions'));
    }

    public function updateRole($id, Request $request)
    {
        $role = Role::findOrFail($id);
        $permission_id = $request->permission_id ? $request->permission_id : [];
        $role->permissions()->sync($permission_id);
        flash()->message('Successfully MOdified');
        return redirect()->back();
        // return redirect('admin/users/roles');
    }
}
