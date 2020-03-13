@extends('layouts.app')

    @section('content')
    <h1>CREATE POST</h1>
        {!! Form::open(['action' => ['PostController@update',$post->id],'method'=>'post','encType'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title','Title')}}    
                {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Enter Title'])}}    
            </div>
            <div class="form-group">
                {{Form::label('body','Body')}}    
                {{Form::textarea('body',$post->body,['class'=>'form-control','placeholder'=>'Enter Body','id'=>'summary-ckeditor'])}}    
            </div>
            <div class="cover_image">
                {{Form::file('cover_image')}}
            </div>
            {!!Form::hidden('_method','PUT')!!}  
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    @endsection