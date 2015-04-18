@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')
	<h1>Books</h1>

	<table class = "table table-striped table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($books as $book)
				<tr>
					<td>
						{{$book->id}}
					</td>
					<td>
						<a href = "{{action('BookController@show', [$book->id])}}">
							{{$book->title}}
						</a>
					</td>
					<td class = "text-right">
						<a href = "{{action('BookController@edit', [$book->id])}}">
							Edit
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>	
@stop