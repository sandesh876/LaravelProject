@extends('layouts/app')
    @section('content')
    <div class="jumbotron text-center">
        <h1>Welcome To Laravel</h1> <!--displaying the value passed from the controller-->
        <p>This is the tutorial of php laravel framework from "Laravel From Scratch" Youtube Series</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
        @endsection
