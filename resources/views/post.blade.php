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


	@if (Auth::check())
		{{-- expr --}}
	
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

	@endif

	<hr>
	@if (count($comments) > 0)
		{{-- expr --}}
		@foreach ($comments as $comment)
			{{-- expr --}}
		
			<div class="media">
				<a class="pull-left" href="#">
					<img height="64" class="media-object" src="{{$comment->photo ? $comment->photo : 'http://placehold.it/64x64'}}" alt=""></img>
				</a>
				<div class="media-body">
					<h4 class="media-heading">{{$comment->author}}
						<small>{{$comment->created_at->diffForHumans()}}</small>
					</h4>
					<p>{{$comment->body}}</p>

					@if (count($comment->replies) > 0)
						{{-- expr --}}					

						@foreach ($comment->replies as $reply)
							{{-- expr --}}
						
							@if ($reply->is_active == 1)
								{{-- expr --}}							

								<div id="nested-comment" class="media">
									<a class="pull-left" href="#">
										<img height="64" class="media-object" src="{{$reply->photo ? $reply->photo : 'http://placehold.it/64x64'}}" alt="">
									</a>
									<div class="media-body">
										<h4 class="media-heading">{{$reply->author}}
											<small>{{$reply->created_at->diffForHumans()}}</small>
										</h4>
										{{$reply->body}}
									</div>

									<div class="comment-reply-container">
									
										<button class="toggle-reply btn btn-primary pull-right">Reply</button>

										<div class="comment-reply">

											{!! Form::open(['method'=>'Post', 'action'=>'CommentRepliesController@createReply']) !!}
												<div class="form-group">
													<input type="hidden" name="comment_id" value="{{$comment->id}}">
												
													{!! Form::label('body', 'Body: ') !!}
													{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
												</div>
												<div class="form-group">
													{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
												</div>
											{!! Form::close() !!}

										</div>

									</div>
								</div>

							@endif

						@endforeach

					@endif

				</div>
			</div>

		@endforeach

	@endif
	

@stop

@section('scripts')

	<script>
		$(".comment-reply-container .toggle-reply").click(function(){
			$(this).next().slideToggle("slow");
		});
	</script>

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

