@extends('layouts.app')
    @section('content')
        <h1>Services</h1>
        <p>This is Services Page.</p>
        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach

        </ul>
    @endsection