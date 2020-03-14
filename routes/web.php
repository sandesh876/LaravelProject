<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*
Route::get('/hello', function () {
     return view('welcome');
    return "<h1>hello world</h1>";
});

//dynamic route
Route::get('/users/{id}/{name}',function($id,$name){
    return "This is User ".$name.' with an id '.$id;
    
    });
*/


Route::get('/', 'PagesController@index');  //calling controller pagescontroller and specifying which method to call

Route::get('/about','PagesController@about');

Route::get('/services','PagesController@services');

Route::resource('posts','PostsController');



