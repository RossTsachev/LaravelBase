@extends('app')

@section('content')
	<h1>Welcome to BookDir</h1>

	@include('errors.list')	

	{!! Form::open(['url' => 'auth/login']) !!}

		{{-- <div class = "form-group">
			{!! Form::label('username', 'Username:') !!}
			{!! Form::text('username', null, ['class' => 'form-control']) !!}
		</div> --}}

		<div class = "form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>

		<div class = "form-group">
			{!! Form::label('password', 'Password:') !!}
			{!! Form::password('password',['class' => 'form-control']) !!}
		</div>

		<div class = "form-group">
			{!! Form::label('remember', 'Remember me') !!}
			{!! Form::checkbox('remember') !!}
		</div>

		<div class = "form-group">
			{!! Form::submit('Enter', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!}

	Not a member? <a href = "{{URL::to('auth/register')}}">Click to register</a>
@stop