@extends('layouts/app') <!--this is just like extending headers and footers in php by writing -->

        @section('content')
        <h1>{{$title}}</h1>
           @if(count($services)>0)
           <ul class="list-group">
                @foreach($services as $service)

                    <li class="list-group-item">{{$service}}</li>
                @endforeach
            </ul>
           @endif
        @endsection
