@extends('app')

@section('navigation')
    @include('partials.navigation')
@stop

@section('content')
    <h1>{{$book->title}}</h1>
    <div class = "panel panel-default">
        <div class = "panel-heading">
            <h3 class = "panel-title">Author(s):</h3>
        </div>
        <ul class = "list-group">
            @foreach($book->authors as $author)
                <li class = "list-group-item">
                    <a href = "{{action('AuthorController@show', [$author->id])}}">
                        {{$author->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class = "panel panel-default arrow left">
        <div class = "panel-heading">
            <h3 class = "panel-title">Comment(s):</h3>
        </div>
        <div class = "panel-body">
            {!! Form::open() !!}

                <div class = "form-group">
                    {!! Form::label('comment', 'Add comment:') !!}
                    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
                </div>

                <div class = "form-group">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
                </div>

            {!! Form::close() !!}
        </div>

        @foreach($book->posts()->simplePaginate(10) as $post) 
        <div class = "panel-body">
        	<header class = "text-left">
            	<div class = "comment-user"><i class = "fa fa-user"></i> {{$post->user->name}}</div>
            	<time 
                    class = "comment-date" 
                    datetime = "{{\Carbon\Carbon::parse($post->created_at)->toDateTimeString()}}"
                >
                    <i class = "fa fa-clock-o"></i> 
                    {{\Carbon\Carbon::parse($post->created_at)->toFormattedDateString()}}
                </time>
          	</header>
          	<div class = "comment-post">
            	<p>
             		{{$post->comment}}
            	</p>
          	</div>
        </div>
        @endforeach
        {!! $book->posts()->simplePaginate(10)->render() !!}
    </div>
@stop