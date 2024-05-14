<?php

namespace App\Http\Controllers\front;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
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
        $posts=Posts::get();
       return view('admin.frontmenu.berita.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frontmenu.berita.create');
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
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'title'         => 'required|unique:posts',
            'content'       => 'required',
        ]);

        //upload image
        $image = $request->FILE('image');
        $image->storeAs('public/berita', $image->hashName());

        $berita = posts::CREATE([
            'image'       => $image->hashName(),
            'title'       => $request->input('title'),
            'content'     => $request->input('content'),
            'operator'    => $request->input('operator'), 

        ]);

        if($berita){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-berita');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-berita');
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
        $posts = Posts::where('id', $id)->first();
        return view('admin.frontmenu.berita.edit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        $this->validate($request,[
            'title'         => 'required|unique:posts,title,'.$posts->id,
            'content'       => 'required',
        ]);

        if ($request->file('image') == "") {
        
            $posts = Posts::findOrFail($posts->id);
            $posts->update([
                'title'       => $request->input('title'),
                'content'     => $request->input('content'),
                'operator'    => $request->input('operator'), 
            ]);

        } else {

            //remove old image
            Storage::disk('local')->delete('public/berita/'.$posts->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/berita', $image->hashName());

            $posts = Posts::findOrFail($posts->id);
            $posts->update([
                'image'       => $image->hashName(),
                'title'       => $request->input('title'),
                'content'     => $request->input('content'), 
                'operator'    => $request->input('operator'), 
            ]);

        }

        if($posts){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-berita');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-berita');
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
        $post= Posts::findOrFail($id);
        $post->delete();
        
        return back();
    }
}
