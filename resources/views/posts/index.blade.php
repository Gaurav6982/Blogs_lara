@extends('layouts.app')

    @section('content')
        @if(count($posts)>0)
            <h1>POSTS</h1>
            @foreach ($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/storage/cover_images/{{$post->cover_image}}" alt="COVER_IMAGE" width="100%">
                        </div>
                        <div class="col-md-8">
                            <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                            <p>Created at:{{$post->created_at}} by {{$post->user->name}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$posts->links()}}
        @else
            <p>No Posts Found.</p>
        @endif
        
    @endsection