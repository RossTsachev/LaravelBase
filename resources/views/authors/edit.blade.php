@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')
	<h1>Update Author</h1>

	@include('errors.list')	

	{!! Form::model($author,[
		'method' => 'PATCH',
		'action' => ['AuthorController@update', 
			$author->id]
		]) !!}

		@include('authors._form', ['submitBtnText' => 'Edit'])

	{!! Form::close() !!}
@stop