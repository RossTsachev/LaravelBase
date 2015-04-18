@extends('app')

@section('content')
	<h1>Registration Form:</h1>

	@include('errors.list')	

	{!! Form::open(['url' => 'auth/register']) !!}

		<div class = "form-group">
			{!! Form::label('name', 'Username:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class = "form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class = "form-group">
			{!! Form::label('password', 'Password:') !!}
			{!! Form::password('password',['class' => 'form-control']) !!}
		</div>
		
		<div class = "form-group">
			{!! Form::label('password_confirmation', 'Confirm Password:') !!}
			{!! Form::password('password_confirmation',['class' => 'form-control']) !!}
		</div>
		
		<div class = "form-group">
			{!! Form::submit('Register', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!}
@stop