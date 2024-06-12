<?php

namespace App\Http\Controllers\admin;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:permession']);
    } 

    public function index()
    {
        $permissions = Permission::get();
        return view('admin.permisseion.index',compact('permissions'));
    }
    public function create()
    {
        return view('admin.permisseion.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required'   
        ]);
        $permission = Permission::create([
            'name'      => $request->input('name')
        ]);
       
        if($permission){
            return redirect('/permission')->with('status','Data Berhasil Ditambah');}
            else{
                return redirect('/permission')->with('error','Gagal Ditambah');
            }
    }
}
