@extends('app')

@section('content')
	<h1>{{$book->title}}</h1>
	<h4>Authors:</h4>
	<ul>
		@foreach($book->authors as $author)
			<li>
				<a href = "{{action('AuthorController@show', [$author->id])}}">
					{{$author->name}}
				</a>
			</li>
		@endforeach
	</ul>

@stop