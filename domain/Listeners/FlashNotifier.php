<?php

namespace MyLibrary\Listeners;

use MyLibrary\Author\AuthorWasStored;
use MyLibrary\Author\AuthorWasEdited;
use MyLibrary\Book\BookWasStored;
use MyLibrary\Book\BookWasEdited;
use MyLibrary\Post\PostWasStored;
use MyLibrary\Eventing\EventListener;
use Session;

class FlashNotifier extends EventListener
{
    public function whenAuthorWasStored(AuthorWasStored $event)
    {
        Session::flash('flash-message', 'The author was saved.');
    }

    public function whenAuthorWasEdited(AuthorWasEdited $event)
    {
        Session::flash('flash-message', 'The author was edited.');
    }

    public function whenBookWasStored(BookWasStored $event)
    {
        Session::flash('flash-message', 'The book was saved.');
    }

    public function whenBookWasEdited(BookWasEdited $event)
    {
        Session::flash('flash-message', 'The book was edited.');
    }

    public function whenPostWasStored(PostWasStored $event)
    {
        Session::flash('flash-message', 'The post was saved.');
    }
}
