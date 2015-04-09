<h1>Welcome to Books Catalogue</h1>

@include('errors.list')	

{!! Form::open(['url' => 'auth/login']) !!}

	{!! Form::label('name', 'Username:') !!}
	{!! Form::text('name') !!}

	{!! Form::label('password', 'Password:') !!}
	{!! Form::password('password') !!}

	{!! Form::label('remember', 'Remember me') !!}
	{!! Form::checkbox('remember') !!}

	{!! Form::submit('Enter') !!}

{!! Form::close() !!}

Not a member? <a href = "{{URL::to('auth/register')}}">Click to register</a>