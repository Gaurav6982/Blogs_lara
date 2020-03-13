@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/storage/profile_images/{{$user->profile_image}}" alt="User Image" style="width:220px;height:200px;border-radius:50%;">
                            {!!Form::open(['action' => 'UserController@image','method'=>'post','encType'=>'multipart/form-data'])!!}
                                {{Form::file('profile_image')}}
                                <br>
                                {{Form::submit('Change Image',['class'=>'btn btn-primary'])}}
                            {!!Form::close()!!}
                            
                        </div>
                        <br>
                            <br>
                            <br>
                        <div class="col-md-7 col-md-offset-2">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                       {{ __('Logout') }}
                      </a>
                        Your Blogs.
                        @if(count($posts) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Blog Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                        <td>
                                            {!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'post','class'=>'pull-right'])!!}
                                                {!!Form::hidden('_method','DELETE')!!}    
                                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                            
                                            {!!Form::close()!!}  
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                        No Post By you.
                        @endif
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
