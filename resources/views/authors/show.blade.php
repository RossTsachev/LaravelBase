@extends('app')

@section('content')
	<h1>{{$author->name}}</h1>
	<h4>Books written:</h4>
	<ul>
		@foreach($author->books as $book)
			<li>
				<a href = "{{action('BookController@show', [$book->id])}}">
					{{$book->title}}
				</a>
			</li>
		@endforeach
	</ul>
@stop