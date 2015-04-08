<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Laravel Base App</title>
	</head>
	<body>
		<ul>
			
			<li><a href = "{{action('BookController@index')}}">All Books</a></li>
			<li><a href = "{{action('AuthorController@index')}}">All Authors</a></li>
			<li><a href = "{{action('BookController@create')}}">Create Book</a></li>
			<li><a href = "{{action('AuthorController@create')}}">Create Author</a></li>
		</ul>

		@yield('content')

	</body>
</html>	