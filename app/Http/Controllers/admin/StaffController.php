<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;


class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff=Staff::get();
        return view('admin.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'name'      => 'required',
            'operator'  => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/staff', $image->hashName());

        $satff =Staff::create([
            'image'    => $image->hashName(),
            'name'     => $request->input('name'),
            'nip'      => $request->input('nip'),
            'email'    => $request->input('email'),
            'operator' => $request->input('operator'), 

        ]);

        if($satff){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-staff');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-staff');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::where('id', $id)->first();
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $this->validate($request,[
            'name'         => 'required',
            'nip'          => 'required|unique:staff,nip,'.$staff->id,
            'email'        => 'required',
            'operator'     => 'required',
        ]);

        if ($request->file('image') == "") {
        
            $staff = Staff::findOrFail($staff->id);
            $staff->update([
                'name'       => $request->input('name'),
                'nip'        => $request->input('nip'),
                'email'      => $request->input('email'),
                'operator'   => $request->input('operator'), 
            ]);

        } else {

            //remove old image
            Storage::disk('local')->delete('public/staff/'.$staff->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/staff', $image->hashName());

            $staff = Staff::findOrFail($staff->id);
            $staff->update([
                'image'     => $image->hashName(),
                'name'      => $request->input('name'),
                'nip'       => $request->input('nip'), 
                'email'     => $request->input('email'), 
                'operator'  => $request->input('operator'), 
            ]);

        }

        if($staff){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-staff');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-staff');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jml= Staff::findOrFail($id);
        $jml->delete();
        if($jml){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return back();
        }
    }
}
