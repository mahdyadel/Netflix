<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['destroy']);

    }// end of __construct
    
      public function index()
    {
        $roles = Role::WhereRoleNot(['super_admin' ] )
        ->whenSearch(request()->search)
        ->with('permissions')
        ->withCount('users')
        ->paginate(5);
        return view('dashboard\roles\index' , compact('roles'));

    }//end of index


    public function create()
    {
        return view('dashboard\roles\create');
    }//end of create

   
    public function store(Request $request)
    {

        $request->validate([

            'name'          =>   'required|unique:roles,name',
            'permissions'   =>   'required|array|min:1',

        ]);

        $role = Role::create($request->all());

        $role->attachPermissions($request->permissions);


        $request->session()->flash('success', 'Data Added Successfuly');

        return redirect()->route('dashboard.roles.index');


    }//end of store

    
    public function show($id)
    {
        //
    }//end of show

    public function edit($id)
    {
        
        $role = Role::findOrfail($id);

        return view('dashboard\roles\edit' , compact('role'));

    }//end of edit

   
    public function update(Request $request, $id)
    {
        $role = Role::findOrfail($id);

        $request->validate([
            'name'          =>   'required|unique:roles,name,'.$role->id,
            'permissions'   =>   'required|array|min:1',
        ]);
        

        $role->name             =   $request->name;
        $role->syncPermissions($request->permissions);

        $role->save();

        
        $request->session()->flash('success', 'Data Updated Successfuly');

        return redirect()->route('dashboard.roles.index');
        

    }//end of update

     
    public function destroy($id)
    {
        
        $role = Role::findOrfail($id);

        $role->delete();

        
        session()->flash('success', 'Data Deleted Successfuly');

        return redirect()->route('dashboard.roles.index');
        

    }//end of destroy

}//end of role controller 
