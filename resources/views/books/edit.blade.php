@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')
	<h1>Edit Book</h1>

	@include('errors.list')		

	{!! Form::model($book,[
			'method' => 'PATCH',
			'action' => ['BookController@update', $book->id]
		]) !!}

		@include('books._form', ['submitBtnText' => 'Edit'])

	{!! Form::close() !!}
@stop