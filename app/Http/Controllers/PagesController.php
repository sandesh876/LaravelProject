<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title="Welcome to Laravel!"; //passing values to the blade template view

        //return view('pages/index',compact('title'));//this ia one way to send value
        return view('pages/index')->with('title', $title);   //title is assigned by the value of $title //you can also write as return view(pages.index) pages is the folder and index is the view page
    }

    public function about(){
        $title="About Us";
        return view('pages/about')->with('title',$title);
    }

    public function services(){
       $data=array(
        'title'=>'Our Services',
        'services'=>['web design','programming','SEO']

       );
        return view('pages/services')->with($data); //passing array of values
    }
}
