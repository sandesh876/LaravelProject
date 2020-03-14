<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if we want to select in order 
       // $posts=Post::orderBy('title','desc')->take(1)->get();  //limiting the posts
        //$posts = Post::all();
        //return Post::where('title','Post Two')->get();
        
        //using db
        //$posts=DB::select('SELECT * FROM posts');
        //$posts=Post::orderBy('title','desc')->paginate(1); //pagination
        $posts=Post::orderBy('created_at','desc')->get();
        return view('posts/index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation of form input
        $this->validate($request,[                   //[]all the validation are written in those brackets
            'title' => 'required',
            'body' => 'required'
        ]);

        //create post and save data to db

        $post=new Post;
        $post->title=$request->input('title'); //this gets whatever is submitted to the form
        $post->body=$request->input('body');
        $post->save();
        //redirecting after post
        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $post= Post::find($id);
        return view('posts/show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
