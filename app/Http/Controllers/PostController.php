<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=array(
            'posts'=>Post::orderBy('created_at','desc')->paginate(5),
            'title'=>"Blogs"
        );
        return view('posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size=fileSize($request->file('cover_image'));
        // return redirect('/posts/create')->with('error',$size);
        if($size>12437063)
        return redirect('/posts/create')->with('error','Size Greater Than 10MB');

        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable'
        ]);
       
            if($request->hasFile('cover_image'))
            {
                $file=$request->file('cover_image')->getClientOriginalName();

                $name=pathinfo($file,PATHINFO_FILENAME);

                $extention=$request->file('cover_image')->getClientOriginalExtension();

                $fileName=$name."_".time().".".$extention;

                $path=$request->file('cover_image')->storeAs('public/cover_images',$fileName);
            }
            else{
                $fileName="noimage.jpg";
            }
        $post=new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->id();
        $post->cover_image=$fileName;
        $post->save();
        return redirect('/posts')->with('success','Post Created');
        // return 132;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=array(
            'post'=>Post::find($id),
            'title'=>'Post'
        );
        
        return view('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        if(auth()->user()->id==$post->user_id)
        return view('posts.edit')->with('post',$post);
        else
        return redirect('/posts')->with('error','UnAuthorized Access');
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
        $size=fileSize($request->file('cover_image'));
        if($size>1999)
        return redirect('/posts/create')->with('error','Greater Size');

        if($request->hasFile('cover_image'))
        {
            $file=$request->file('cover_image')->getClientOriginalName();

            $name=pathinfo($file,PATHINFO_FILENAME);

            $extention=$request->file('cover_image')->getClientOriginalExtension();

            $fileName=$name."_".time().".".$extention;

            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileName);
        }
        $post=Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image'))
        $post->cover_image=$fileName;
        $post->save();
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
        $post=Post::find($id);
       
        if(auth()->user()->id==$post->user_id)
        {
            $post->delete();
            return redirect('/posts')->with('success','Post Removed');
        }
        if($post->cover_image != 'noimage.jpg')
        {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        else
        return redirect('/posts')->with('error','UnAuthorized Access');
    }
}
