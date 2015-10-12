<div class = "form-group">
	{!! Form::label('title', 'Book title:') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class = "form-group">
	{!! Form::label('author_list', 'Author(s):') !!}
	{!! Form::select('author_list[]', $authors, null, ['multiple', 'class' => 'form-control select2', 'id' => 'authorList']) !!}
</div>

<div class = "form-group">
	{!! Form::submit($submitBtnText, ['class' => 'btn btn-primary form-control']) !!}
</div>