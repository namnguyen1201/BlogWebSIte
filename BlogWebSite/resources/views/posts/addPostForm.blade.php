@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	        	<div class="card">
	        		<div class="card-body">
			            <h1>Create Post</h1>
						{!! Form::open(['url'=>'addPost', 'enctype'=>'multipart/form-data']) !!}
							<div class="form-group">
								{!! Form::token() !!}
								{!! Form::label('titlelabel', 'Title') !!}
								{!! Form::text('titletext', '', ['class'=>'form-control', 'placeholder'=>'Title']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('contentlabel', 'Content') !!}
								{!! Form::textarea('contenttext', '', ['class'=>'form-control', 'placeholder'=>'Content']) !!}<br>
								{!! Form::file('cover_image') !!}<br><br>
								{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
							</div>
						{!! Form::close() !!}
					</div>
				</div>
	        </div>
	    </div>
	</div>
@endsection

