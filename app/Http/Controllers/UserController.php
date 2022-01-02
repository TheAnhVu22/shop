<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    //

    public function index()
    {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'manager product']);
        $user = User::with('roles','permissions')->get();
        return view('admincp.user.index', compact('user'));
    }
    public function delete_user($id)
    {
        $user = User::find($id);
        if(Auth::id()==$id){
            return redirect()->back()->with('status','không được xóa tài khoản đang dùng hiện tại');
        }
        if($user){
            $user->roles()->detach();
            $user->delete();
        }
        return redirect()->back()->with('status','xóa tài khoản thành công');
    }
    public function assign_per($id)
    {
        $user = User::find($id);
        $roles = $user->roles->first();
        $permission = Permission::orderBy('id','DESC')->get();
        $get_permission_via_role = $user->getPermissionsViaRoles();
        return view('admincp.user.quyen',compact('user','roles','permission','get_permission_via_role'));
    }
    public function assign_role($id)
    {
        $user = User::find($id);
        $roles = $user->roles->first();
        $role = Role::orderBy('id','DESC')->get();
        return view('admincp.user.vaitro',compact('user','roles','role'));
    }

    public function phan_vaitro(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        // phân vai trò: syncRoles: nếu có thì xóa cái cũ đi, thêm cái mới vào
        $user->syncRoles($data['vaitro']);
        return redirect()->back()->with('status','Thêm vai trò cho user thành công');
    }
    public function them_vaitro(Request $request)
    {
        $data = $request->all();
        $role = Role::create(['name' => $data['role_name']]);
         return redirect()->back()->with('status','Thêm vai trò mới thành công');
    }
    public function phan_quyen(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        // phân quyền: ghi đè lên quyền cũ
        $role = Role::find($role_id);
        $role->syncPermissions($data['permission']);
        return redirect()->back()->with('status','Thêm quyền cho user thành công');
    }
    public function them_quyen(Request $request)
    {
        $data = $request->all();
        $per = Permission::create(['name' => $data['per_name']]);
         return redirect()->back()->with('status','Thêm quyền mới thành công');
    }
}
