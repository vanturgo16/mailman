<?php

namespace App\Http\Controllers\front;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
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
        $event=Event::get();
       return view('admin.frontmenu.event.index',compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frontmenu.event.create');
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
            'title'         => 'required|unique:events',
            'content'       => 'required',
            'location'      => 'required',
            'date'          => 'required',
            'operator'      => 'required',
        ]);

        //upload image
        $image = $request->FILE('image');
        $image->storeAs('public/event', $image->hashName());

        $event =Event::create([
            'image'       => $image->hashName(),
            'title'       => $request->input('title'),
            'content'     => $request->input('content'),
            'location'    => $request->input('location'),
            'date'        => $request->input('date'),
            'operator'    => $request->input('operator'), 

        ]);

        if($event){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-event');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-event');
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
        $event = Event::where('id', $id)->first();
        return view('admin.frontmenu.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate($request,[
            'title'         => 'required|unique:events,title,'.$event->id,
            'content'       => 'required',
            'location'      => 'required',
            'date'          => 'required',
            'operator'      => 'required',
        ]);

        if ($request->file('image') == "") {
        
            $event = Event::findOrFail($event->id);
            $event->update([
                'title'       => $request->input('title'),
                'content'     => $request->input('content'),
                'location'    => $request->input('location'),
                'date'        => $request->input('date'),
                'operator'    => $request->input('operator'), 
            ]);

        } else {

            //remove old image
            Storage::disk('local')->delete('public/event/'.$event->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/event', $image->hashName());

            $event = Event::findOrFail($event->id);
            $event->update([
                'image'       => $image->hashName(),
                'title'       => $request->input('title'),
                'content'     => $request->input('content'), 
                'operator'    => $request->input('operator'), 
            ]);

        }

        if($event){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-event');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-event');
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
        $event= Event::findOrFail($id);
        $event->delete();
        
        return back();
    }
}
