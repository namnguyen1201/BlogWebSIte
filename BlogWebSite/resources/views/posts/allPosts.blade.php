@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">
	                	<h5>All Posts</h5>
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
                                </div>
                                <div class="col-md-8 col-sm-4">
                                	<h3><a href="{{$post->id}}/guest">{{$post->title}}</a></h3>
                                	<small>Written on {{$post->created_at}} by {{ App\User::where('id', '=', ''.$post->author_id)->get()[0]->name }}</small>
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

