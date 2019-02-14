<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Discussion;
use App\Reply;
use Session;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
        return view('discussion.index', ['discussions' => $discussions]);
    }

    public function create()
    {
        return view("discussion.create");
    }

    public function store()
    {
        $r = request();
        $r->validate([
            'title' => 'required|unique:channels|max:100',
            'content' => 'required',
            'channel' => 'required'
        ]);

        $d = Discussion::create([
            'title' => $r->title,
            'content' => $r->get('content'),
            'channel_id' => $r->channel,
            'user_id' => Auth::id(),
            'slug' => str_slug($r->title)
        ]);

        $d->save();
        Session::flash('success', 'New discussion created successfully!');
        return redirect()->back();

    }

    public function edit($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        if (Auth::user()->id == $discussion->user_id or Auth::user()->admin == 1) {
            return view('discussion.edit', ['discussion' => $discussion]);
        }
        return redirect()->back();
    }

    public function update($id)
    {
        request()->validate([
            'content' => 'required'
        ]);
        $discussion = Discussion::find($id);
        if (Auth::user()->id == $discussion->user_id or Auth::user()->admin == 1) {
            $discussion->content = request()->content;
            $discussion->save();
            return redirect()->route('discussion.show', ['discussion' => $discussion->slug]);
        }
        Session::flash('success', 'The discussion updated successfully!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $discussion = Discussion::find($id);
        if (Auth::user()->id == $discussion->user_id or Auth::user()->admin == 1) {
            Discussion::destroy($id);
            Session::flash('success', 'The discussion deleted successfully!');
            return redirect()->route('discussion.index');
        }
        return redirect()->back();
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        $replies = Reply::where('discussion_id', $discussion->id)->paginate(3);
        return view('discussion.single', ['discussion' => $discussion, 'replies' => $replies]);
    }

    public function best_reply($id, $reply_id)
    {
        $reply = Reply::find($reply_id);
        if ($reply->discussion_id == $id) {
            $this->remove_best_reply($id);
            $discussion = Discussion::find($id);
            $discussion->best_reply = $reply_id;
            $discussion->save();
            Session::flash('success', 'You choose a reply as the best answer!');
        }
        return redirect()->back();
    }

    public function remove_best_reply($id)
    {
        $discussion = Discussion::find($id);
        $discussion->best_reply = Null;
        $discussion->save();
        Session::flash('success', 'The best answer deselected!');
        return redirect()->back();
    }

    public function close($did)
    {
        $discussion = Discussion::find($did)->first();
        $discussion->close = 1;
        $discussion->save();
        return redirect()->back();
    }

    public function open($did)
    {
        $discussion = Discussion::find($did)->first();
        $discussion->close = 0;
        $discussion->save();
        return redirect()->back();
    }

}
