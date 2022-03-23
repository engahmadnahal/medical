<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::withCount('permissions')->get();
        return view("roles.index",['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("roles.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            "name" => "required|string",
            "guard_name" => "required|exists:roles,guard_name"

        ]);
        if(!$validator->fails()){
            $role = new Role();
            $role->name = $request->input("name");
            $role->guard_name = $request->input("guard_name");
            $isSave = $role->save();
            return response()->json(
                ["msg"=> $isSave ? __('cms.create_success') : __('cms.create_fail')],
                $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        );

        }else{
            return response()->json(
                ["msg"=>$validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

        $permissions = Permission::where('guard_name',$role->guard_name)->get();
        $rolePermissions = $role->permissions;
        if(count($rolePermissions) > 0){
            foreach($permissions as $permission){
                $permission->setAttribute('assign',false);
                foreach($rolePermissions as $rolePermission){
                    if($rolePermission->id == $permission->id){
                        $permission->setAttribute('assign',true);
                    }
                }
            }
        }
        return view('roles.rol-permissions',['role'=>$role,'permissions'=>$permissions]);
    }

    public function updateRolePermission(Request $request){
        $validator = Validator($request->all(),[
            'role_id'=>'required|numeric|exists:roles,id',
            'permission_id'=>'required|numeric|exists:permissions,id',
        ]);
        if(!$validator->fails()){
            $role = Role::findOrFail($request->input('role_id'));
            $permission = Permission::findOrFail($request->input('permission_id'));
            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
            }else{
                $role->givePermissionTo($permission);
            }
            return response()->json(
                ["msg"=> "Save is Success"],
                Response::HTTP_OK
            );
        }else{
            return response()->json(
                ["msg"=>$validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {


        return view("roles.edit",["role"=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator($request->all(),[
            "name" => "required|string",
            "guard_name" => "required|exists:roles,guard_name"

        ]);
        if(!$validator->fails()){
            $role->name = $request->input("name");
            $role->guard_name = $request->input("guard_name");
            $isSave = $role->save();
            return response()->json(
                ["msg"=> $isSave ? __('cms.update_success') : __('cms.update_fail')],
                $isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );

        }else{
            return response()->json(
                ["msg"=>$validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
