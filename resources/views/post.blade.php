@extends('layouts.blog-post')

@section('content')

	

	<h1>{{$post->title}}</h1>

	<p class="lead">
		by <a href="#">{{$post->user->name}}</a>
	</p>

	<hr>

	<p><span class="glyphicon glyphicon-time">Posted {{$post->created_at->diffForHumans()}}</span></p>

	<hr>

	<img class="img-repsonsive" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}"></img>

	<hr>

	<p>{{$post->body}}</p>

	<hr>

	@if (Session::has('comment_message'))
		{{-- expr --}}
		{{session('comment_message')}}
	@endif

	<div class="well">
		<h4>Leave a Comment: </h4>

		{!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

			<input type="hidden" name="post_id" value="{{$post->id}}">

			<div class="form-group">
				{!! Form::label('body', 'Body: ') !!}
				{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
			</div>

		{!! Form::close() !!}

	</div>

	<hr>

@stop

@section('well')

	<div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">{{$post->category ? $post->category->name : 'No category'}}</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <!-- /.row -->
            </div>

@stop