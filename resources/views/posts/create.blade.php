@extends('layouts/app')

@section('content')

<h1>Create Post</h1>

{!! Form::open(['action'=> 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}   <!--enctype attributes are used in file uploading-->
    <div class="form-group">
        {{Form::label('title','Title')}}   <!-- double curly is used for echoing data (name title ,scr ma display hune Title-->
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}   <!--[ inside we can use attributes lie bootstrap classes placeholder etc]-->
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}   <!-- double curly is used for echoing data (name title ,scr ma display hune Title-->
        {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}   <!--[ inside we can use attributes lie bootstrap classes placeholder etc]-->
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}

    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection