<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Laravel Base App</title>

		<link href="/css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.0.1/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="//cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">


		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		@yield('navigation')
		<div class="container">
			@include('partials.flash')

			@yield('content')
		</div>
		
	    <script src="/js/all.js"></script>
	    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	  	@stack('scripts')
		<script src="//cdn.datatables.net/buttons/1.0.1/js/dataTables.buttons.min.js"></script>
		<script src="//cdn.datatables.net/buttons/1.0.1/js/buttons.flash.min.js"></script>
		<script src="//cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
	</body>
</html>	