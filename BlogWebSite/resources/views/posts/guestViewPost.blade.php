@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	            	<div class="card-body">
	                    <h3>{{$post->title}}</h3>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	            	<div class="card-header">
	                    <h6>Author - {{ App\User::where('id', '=', ''.$post->author_id)->get()[0]->name }}</h6>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-body">
	                    {!! Form::textarea('contenttext', ''.$post->content, ['class'=>'form-control', 'placeholder'=>'Content', 'cols'=>15, 'rows'=>15, 'readonly'=>'true']) !!}
	                    <small id="numOfLikes">{{ App\Like::where('post_id', '=', $post->id)->count() }} Like(s)</small>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	@if((auth()->user()->id)!=($post->author_id))
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">
		                    @if (App\Like::where([['user_id', '=', auth()->user()->id], ['post_id', '=', $post->id]])->count() == 0)
		                    	<button type="button" onclick="liked()" id="like">Like</button>
		                    @else <button type="button" onclick="liked()" id="like">Liked</button>
		                    @endif
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	@endif
							
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	            	<button style="display: none" id="postId">{{$post->id}}</button>

	            	@foreach ($comments as $comment)
	            		<div class="card-header">
	            			<h6>{{ App\User::find($comment->user_id)->name }} commented on {{$comment->created_at}}</h6>
	            		</div>
	            		<div class="card-body">
	            			<h6>{{$comment->comments}}</h6>
	            		</div>
	                @endforeach

            		<div class="card-body">
            			<button style="display: none" id="commentor">{{ auth()->user()->name }} commented on {{ date("Y-m-d h:m:s") }}</button>
            			<h6 id="showcomment"></h6>
            		</div>

	                <div class="card-header">
	                	<form class="form-group">
	                		<input type="text" id="commenttext" placeholder="Comments">
	                    	<button type="button" onclick="comment()">Add</button>
	                	</form>
	                </div>

	            </div>
	        </div>
	    </div>
	</div>

	<script>
		function liked() {
		  var req = new XMLHttpRequest();
		  req.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	var res = JSON.parse(this.responseText);
		      	document.getElementById("like").innerHTML = res[0];
		      	document.getElementById("numOfLikes").innerHTML = res[1]+(" Like(s)");
		    }
		  };
		  var state = document.getElementById("like").innerHTML;
		  var postId = document.getElementById("postId").innerHTML;
		  req.open("get", "/BlogWebSite/public/".concat(state, "/", postId), true);
		  req.send();
		}

		function comment() {
		  var req = new XMLHttpRequest();
		  req.onreadystatechange = function() {
		  	console.log(document.getElementById("commentor").innerHTML);

		    if (this.readyState == 4 && this.status == 200) {
		    	//document.getElementById("showcommentor").innerHTML += document.getElementById("commentor").innerHTML+"<br>";
		    	document.getElementById("showcomment").innerHTML += document.getElementById("commentor").innerHTML+"<br>" + document.getElementById("commenttext").value+"<br><br>";
		    	document.getElementById("commenttext").value = "";
		    }
		  };
		  var postId = document.getElementById("postId").innerHTML;
		  var comments = document.getElementById("commenttext").value;
		  req.open("get", "/BlogWebSite/public/".concat(comments, "/", postId), true);
		  req.send();
		}
	</script>
@endsection