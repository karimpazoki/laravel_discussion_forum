<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Discussion;
use App\Reply;
use Hash;
use Session;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #dd( User::find($id));
        #dd(Reply::where('user_id', $id)->get());
        return view('profile.index', [
            'user' => User::find($id),
            'discussions' => Discussion::where('user_id',$id)->orderBy('id')->paginate(10),
            'replies' => Reply::where('user_id', $id)->orderBy('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check())
            if($id == Auth::user()->id)
                return view('profile.edit')->with('user', Auth::user());
        return redirect()->back();
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
        if(Auth::check())
            if($id == Auth::user()->id) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                ]);
                $user = Auth::user();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                Session::flash('success', 'The profile updated successfully!');
                return redirect()->route('profile.show',['profile' => $id]);
            }
        return redirect()->back();
    }

    public function changePassword()
    {
        return view('profile.passwordReset');
    }

    public function resetPassword()
    {
        $request = request();
        if(Hash::check($request->old, Auth::user()->password))
        {
            $user = Auth::user();
            if($request->new == $request->rep) {
                $user->password = bcrypt($request->new);
                $user->save();
                Session::flash('success', 'Your password changed successfully!');
            }
            else
                return redirect()->back();
        }
        else
            return redirect()->back();
        return redirect()->route('profile.show',['profile' => Auth::user()->id]);
    }

}
