<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function image(Request $request){
        $size=fileSize($request->file('profile_image'));
        if($size>11437063)
        return redirect('/posts')->with('error','Size Greater Than 10MB');
        if($request->hasFile('profile_image'))
        {
            $user=auth()->user()->id;
            $main=User::find($user);
            // $temp=new User;
            if($main->profile_image != 'new_user.jpg')
            {
                Storage::delete('public/profile_images/'.$main->profile_image);
            }
            // $file=$request->file('profile_image')->getClientOriginalName();
            // $name=pathinfo($file,PATHINFO_FILENAME);
            // $ext=$request->file('profile_image')->getClientOriginalExtension();
            // $filename=$name.'_'.time().'.'.$ext;
            $filename=auth()->user()->id.'.jpg';
            // $path=$request->file('profile_image')->storeAs('public/profile_images',$filename);
           
            $path=$request->file('profile_image')->storeAs('public/profile_images',$filename);

           
            $main->profile_image=$filename;
            if($main->save())
            return redirect('/dash')->with('success','Image Uploaded');
            else
            return redirect('/dash')->with('error','Some Error Occured');
        }
        else
        return redirect('/dash')->with('error','No Image Uploaded');
        
    }
}
