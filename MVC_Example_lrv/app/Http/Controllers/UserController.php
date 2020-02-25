<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'rank' => 'required|numeric',
            'is_active' => 'required|numeric',
        ]);
        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'Sucess!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'rank' => 'required|numeric',
            'is_active' => 'required|numeric',
        ]);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Sucess!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Sucess!');
    }
    public function getSearch(Request $request)
    {
        // $user = User::where('full_name','like','%'.$request->key.'%')->orWhere('id',$request->key)->paginate(5) ;
        // return view('users.search',compact('user'));

        $user = User::where('full_name', 'like', '%' . $request->key . '%')->paginate(5);
        return view('users.search', compact('user'));
    }
}
