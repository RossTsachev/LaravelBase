@extends('app')

@section('content')
	<h1>Authors</h1>

	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($authors as $author)
				<tr>
					<td>
						{{$author->id}}
					</td>
					<td>
						<a href = "{{action('AuthorController@show', [$author->id])}}">{{$author->name}}</a>
					</td>
					<td>
						<a href = "{{action('AuthorController@edit', [$author->id])}}">Edit</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>	
@stop