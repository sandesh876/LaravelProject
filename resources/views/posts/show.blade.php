@extends('layouts/app')

@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>

<h1>{{$post->title}}</h1>
<div>
    {!!$post->body!!}  <!--!! is for parsing html of the text editor-->
</div>
<hr>
<small>Written on {{$post->created_at}}</small>
@endsection