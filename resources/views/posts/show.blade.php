@extends('layouts.app')

    @section('content')
        <a href="/posts" class="btn btn-default">Go Back</a>
        <div>
            <br>
            <br>
            <div class="block" >
                <img src="/storage/cover_images/{{$post->cover_image}}" alt="Cover_image" style="width:100%">    
            </div>
            <br>
            <br>
            <br>   
            <h1>{{$post->title}}</h1>
            <p>{!!$post->body!!}</p>
        </div>
        <hr>
        <div>
            <p>Created_at:{{$post->created_at}}</p>
        </div>
        @if(!Auth::guest())
            @if(Auth::user()->id==$post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'post','class'=>'pull-right'])!!}
                {!!Form::hidden('_method','DELETE')!!}    
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                
            {!!Form::close()!!}
            @endif
        @endif
        <br>
        <br>
    @endsection