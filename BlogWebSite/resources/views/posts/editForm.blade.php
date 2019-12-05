@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	        	<div class="card">
	        		<div class="card-body">
			            <h1>Edit Post</h1>
							{!! Form::open(['url'=>$post->id.'/edit']) !!}
								<div class="form-group">
									{!! Form::token() !!}
									{!! Form::hidden('id', ''.$post->id) !!}
									{!! Form::label('titlelabel', 'Title') !!}
									{!! Form::text('titletext', ''.$post->title, ['class'=>'form-control', 'placeholder'=>'Title']) !!}
								</div>
								<div class="form-group">
									{!! Form::label('contentlabel', 'Content') !!}
									{!! Form::textarea('contenttext', ''.$post->content, ['class'=>'form-control', 'placeholder'=>'Content']) !!}<br>
									{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
								</div>
							{!! Form::close() !!}
					</div>
				</div>
	        </div>
	    </div>
	</div>
@endsection

