@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')
	<h1>{{$book->title}}</h1>
	<div class = "panel panel-default">
		<div class = "panel-heading">
			<h3 class = "panel-title">Author(s):</h3>
		</div>
		<ul class = "list-group">
			@foreach($book->authors as $author)
				<li class = "list-group-item">
					<a href = "{{action('AuthorController@show', [$author->id])}}">
						{{$author->name}}
					</a>
				</li>
			@endforeach
		</ul>
	</div>

@stop