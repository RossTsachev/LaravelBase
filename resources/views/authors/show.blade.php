@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')
	<h1>{{$author->name}}</h1>
	<div class = "panel panel-default">
		<div class = "panel-heading">
			<h3 class = "panel-title">Book(s) written:</h3>
		</div>
		<ul class = "list-group">
			@foreach($author->books as $book)
				<li class = "list-group-item">
					<a href = "{{action('BookController@show', [$book->id])}}">
						{{$book->title}}
					</a>
				</li>
			@endforeach
		</ul>
	</div>
@stop