<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate('5');
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
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
            'category_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'view' => 'required|numeric',
            'is_active' => 'required|numeric',
            'content' => 'required',
        ]);
        Blog::create($request->all());
        return redirect()->route('blogs.index')->with('success', 'Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $actual_link = $_SERVER['REQUEST_URI'];
        $tmpUrl = explode('/', $actual_link);
        $id = $tmpUrl[2];
        //$user = User::where('id','=',$id)->first();
        //dd($user);
        $blog = Blog::where('id', '=', $id)->first();
        $userid = $blog->user_id;
        $user = User::where('id', '=', $userid)->first();
        return view('blogs.show', compact(['blog', 'user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'view' => 'required|numeric',
            'is_active' => 'required|numeric',
            'content' => 'required',
        ]);
        $blog->update($request->all());
        return redirect()->route('blogs.index')->with('success', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Success!');
    }
    public function getSearch(Request $request)
    {
        $blog = Blog::where('title', 'like', '%' . $request->key . '%')->orWhere('id', $request->key)->paginate(5);
        return view('blogs.search', compact('blog'));
    }
}
