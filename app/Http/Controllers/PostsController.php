<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    /**
     * Create Simple CRUD Operations in Laravel 5
     * https://www.phplaraveltutorial.com/2018/03/crud-operations-laravel-5.html
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::latest()->paginate(5);
        return view('posts.index',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Create Simple CRUD Operations in Laravel 5
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

    }

    /**
     * Create Simple CRUD Operations in Laravel 5
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            ]);
        Posts::create($request->all());
        return redirect()->route('posts.index')
            ->with('success','Post created successfully');
    }

    /**
     * Create Simple CRUD Operations in Laravel 5
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Create Simple CRUD Operations in Laravel 5
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $posts = Posts::find($id);
        return view('posts.edit',compact('posts'));
    }

    /**
     * Create Simple CRUD Operations in Laravel 5
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);
        Posts::find($id)->update($request->all());
        return redirect()->route('posts.index')
            ->with('success','Post updated successfully');
    }

    /**
     * Create Simple CRUD Operations in Laravel 5
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posts::find($id)->delete();
        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully');
    }



}
