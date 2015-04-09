<h1>Registration Form:</h1>

@include('errors.list')	

{!! Form::open(['url' => 'auth/register']) !!}

	{!! Form::label('name', 'Username:') !!}
	{!! Form::text('name') !!}

	<br/>

	{!! Form::label('email', 'Email:') !!}
	{!! Form::email('email') !!}

	<br/>

	{!! Form::label('password', 'Password:') !!}
	{!! Form::password('password') !!}

	<br/>

	{!! Form::label('password_confirmation', 'Confirm Password:') !!}
	{!! Form::password('password_confirmation') !!}

	<br/>

	{!! Form::submit('Register') !!}

{!! Form::close() !!}