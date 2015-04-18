@if(Session::has('flash-message'))
	<div class = "alert alert-success">
		<button 
			type = "button" 
			class = "close"
			data-dismiss = "alert"
			area-hidden = "true"
		>
			&times;
		</button>	

		{{Session::get('flash-message')}}
	</div>
@endif