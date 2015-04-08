{!! Form::label('title', 'Book title:') !!}
{!! Form::text('title') !!}

<br/>

{!! Form::label('author_list', 'Author(s):') !!}
{!! Form::select('author_list[]', $authors, null, ['multiple']) !!}

<br/>

{!! Form::submit($submitBtnText) !!}