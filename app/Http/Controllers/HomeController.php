<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        $data=array(
            'posts'=>$user->posts,
            'user'=>$user
        );
        return view('home')->with($data);
    }

    public function image(Request $request){
        $size=fileSize($request->hasFile('profile_image'));
        return redirect('/posts')->with('error',$size);
    }
    
}
