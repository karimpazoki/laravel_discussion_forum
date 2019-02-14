<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index')->with('users', User::orderBy('id','desc')->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = $request;

        $password = uniqid();

        $r->validate([
            'name' => 'required|max:80',
            'email' => 'required|email',
        ]);

        if($r->has('admin'))
            $admin = 1;
        else
            $admin = 0;
        $avatar_new_name = 'avatar.png';

        if($r->hasFile('avatar'))
        {
            $avatar_new_name = time().$r->file('avatar')->getClientOriginalName();
            $r->file('avatar')->move('avatars', $avatar_new_name);
        }

        $user = User::create([
            'name' =>$r->name ,
            'email' => $r->email ,
            'admin' => $admin ,
            'avatar' => 'avatars/'.$avatar_new_name ,
            'password' => bcrypt($password) ,
        ]);
        $user->save();
        Session::flash('success', 'New user created!');
        return redirect()->route('user.index');
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
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
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
            'name' => 'required|max:80',
            'email' => 'required|email',
        ]);

        if($r->has('admin'))
            $admin = 1;
        else
            $admin = 0;

        $user = User::find($id);

        if($r->hasFile('avatar'))
        {
            $avatar_new_name = time().$r->file('avatar')->getClientOriginalName();
            $r->file('avatar')->move('avatars', $avatar_new_name);
            $user->avatar = "avatars/".$avatar_new_name;
        }

        $user->name = $r->name;
        $user->email = $r->email;
        $user->admin = $admin;

        $user->save();
        Session::flash('success', 'The user updated successfully!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('success', 'The user deleted successfully!');
        return redirect()->route('user.index');
    }
}
