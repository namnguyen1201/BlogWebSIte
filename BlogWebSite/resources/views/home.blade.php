@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="addPostForm">New post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($posts as $post)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-4"><img style="width:100%" src="cover_images/{{$post->cover_image}}">
                                <small>Written on {{$post->created_at}}</small>
                                </div>
                                <div class="col-md-8 col-sm-4">
                                    <h6>{{$post->title}}</h6>
                                    <a class="btn btn-primary" href="{{$post->id}}/editForm">Edit</a>
                                    <a class="btn btn-primary" onclick="return confirm('Are you sure?')" href="{{$post->id}}/delete">Delete</a>
                                </div>                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <br>{!! $posts->links(); !!}
            </div>
        </div>
    </div>
@endsection