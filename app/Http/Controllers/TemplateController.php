<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:master parameter']);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifications = Classification::get();
        $datas = Template::orderBy('template_name','asc')->get();
        return view('parameter.template.index',compact('datas','classifications'));
    }

    public function listTemplateKeluar(){
        $classifications = Classification::get();
        $datas = Template::orderBy('template_name','asc')->get();
        return view('parameter.template.list',compact('datas','classifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('hai');
        $request->validate([
            "nama_template" => "required",
            "versi" => "required",
            "tanggal_efektif_awal" => "required",
            "tanggal_efektif_akhir" => "required",
            "kategori" => "required",
            "file_template" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;

            if ($request->hasFile('file_template')) {
                $path_loc = $request->file('file_template');
                $filename = $path_loc->getClientOriginalName();
                $extension = $path_loc->getClientOriginalExtension();
                $url = $path_loc->move('storage/template', $filename);
            }

            $store = Template::create([
                'template_name' => $request->nama_template,
                'template_version' => $request->versi,
                'template_b_date' => $request->tanggal_efektif_awal,
                'template_e_date' => $request->tanggal_efektif_akhir,
                'classification_id' => $request->kategori,
                'template_desc' => $request->keterangan,
                'template_path' => $url->getPath(),
                'template_filename' => $filename,
                'template_filetype' => $extension,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Template Surat Keluar']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Template Surat Keluar!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "nama_template" => "required",
            "versi" => "required",
            "tanggal_efektif_awal" => "required",
            "tanggal_efektif_akhir" => "required",
            "kategori" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;

            if ($request->hasFile('file_template')) {
                $path_loc = $request->file('file_template');
                $filename = $path_loc->getClientOriginalName();
                $extension = $path_loc->getClientOriginalExtension();
                $url = $path_loc->move('storage/template', $filename);
    
                $store = Template::where('id',$id)
                ->update([
                    'template_path' => $url->getPath(),
                    'template_filename' => $filename,
                    'template_filetype' => $extension
                ]);
            }

            $store = Template::where('id',$id)
                ->update([
                    'template_name' => $request->nama_template,
                    'template_version' => $request->versi,
                    'template_b_date' => $request->tanggal_efektif_awal,
                    'template_e_date' => $request->tanggal_efektif_akhir,
                    'classification_id' => $request->kategori,
                    'template_desc' => $request->keterangan,
                    'created_by' => $user,
                ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Naskah Dinas']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Naskah Dinas!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Template::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Template Surat keluar']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Template Surat keluar!']);
        }
    }

    public function aktif($id){
        //dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Template::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Template Surat keluar']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Template Surat keluar!']);
        }
    }
}
