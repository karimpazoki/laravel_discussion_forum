<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;
use App\Discussion;
use Session;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("channel.index")->with("channels", Channel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("channel.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:channels|max:100',
        ]);

        $channel = Channel::create([
            "title" => $request->title,
            "slug" => str_slug($request->title)
            ]
        );
        $channel->save();
        Session::flash('success', 'New channel created!');
        return redirect()->route("channels.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $channel = Channel::where('slug',$slug)->first();
        if(isset($channel))
        {
            $discussions = Discussion::where('channel_id',$channel->id)->orderBy('created_at','desc')->paginate(2);
            return view('discussion.index',['discussions' => $discussions]);
        }
        return redirect('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::find($id);
        return view("channel.edit")->with("channel", $channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $r = $request;
        $r->validate([
            'title' => 'required|unique:channels|max:100',
        ]);

        $channel = Channel::find($id);
        $channel->title = $r->title;
        $channel->save();
        Session::flash('success', 'The channel edited successfully!');
        return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Channel::destroy($id);
        Session::flash('success', 'The channel deleted successfully!');
        return redirect()->route('channels.index');
    }
}
