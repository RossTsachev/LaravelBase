<div class = "form-group">
	{!! Form::label('name', 'Author name:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class = "form-group">
	{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary form-control']) !!}
</div>