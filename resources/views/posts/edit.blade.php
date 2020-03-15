@extends('layouts/app')

@section('content')

<h1>Edit Post</h1>

{!! Form::open(['action'=> ['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}   <!-- double curly is used for echoing data (name title ,scr ma display hune Title-->
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}   <!--[ inside we can use attributes lie bootstrap classes placeholder etc]-->
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}   <!-- double curly is used for echoing data (name title ,scr ma display hune Title-->
        {{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body Text'])}}   <!--[ inside we can use attributes lie bootstrap classes placeholder etc]-->
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}

    </div>
    {{Form::hidden('_method','PUT')}}  <!--This is done because update is a put request and we are doing post request ..it is called spoofing-->
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection