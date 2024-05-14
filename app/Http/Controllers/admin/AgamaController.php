<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\agama;

class AgamaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $agama=agama::get();
        return view('admin.agama.index',compact('agama'));
    }
}
