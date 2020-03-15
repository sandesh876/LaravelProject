<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]); //putting exceptionsfor guests to visit some pages
    }

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
            'body' => 'required',
            'cover_image'=>'image|nullable|max:1999'  //this has to be image or not and size of image
        ]);

        //handle file upload
        if($request->hasFile('cover_image'))
        {
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); //pathinfo is php command

            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image

            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }
        else
        {
            $fileNameToStore='noimage.jpg';
        }

        //create post and save data to db

        $post=new Post;
        $post->title=$request->input('title'); //this gets whatever is submitted to the form
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image= $fileNameToStore;
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
        $post= Post::find($id);
            //check for correct user
            if(auth()->user()->id !== $post->user_id)
            {
                return redirect('/posts')->with ('error','Unauthorized Page');
            }

        return view('posts/edit')->with('post',$post);
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
         //validation of form input
         $this->validate($request,[                   //[]all the validation are written in those brackets
            'title' => 'required',
            'body' => 'required'
        ]);

        //handle file upload
        if($request->hasFile('cover_image'))
        {
            //get filename with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); //pathinfo is php command

            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image

            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }


        $post=Post::find($id);
        $post->title=$request->input('title'); //this gets whatever is submitted to the form
        $post->body=$request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        //redirecting after post
        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        //check for correct user
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with ('error','Unauthorized Page');
        }
        if($post->cover_image !='noimage.jpg')
        {
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');
    }
}
