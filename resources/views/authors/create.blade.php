@extends('app')

@section('navigation')
	@include('partials.navigation')
@stop

@section('content')
	<h1>Create new Author</h1>

	@include('errors.list')		

	{!! Form::open(['url' => 'authors']) !!}

		@include('authors._form', ['submitBtnText' => 'Save'])

	{!! Form::close() !!}
@stop