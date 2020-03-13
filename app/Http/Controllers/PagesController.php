<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index')->with('title',"INDEX");
    }
    public function about(){
        $title="ABOUT";
        return view('pages.about',compact('title'));
    }
    public function services(){
        $data=array(
            'title'=>'SERVICES',
            'services'=>['Web Design','Programming','DESIGN']
        );
        return view('pages.services')->with($data);
    }
}
