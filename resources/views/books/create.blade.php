@extends('app')

@section('content')
	<h1>Create new Book</h1>

	@include('errors.list')		

	{!! Form::open(['url' => 'books']) !!}

		@include('books._form', ['submitBtnText' => 'Save'])

	{!! Form::close() !!}
@stop