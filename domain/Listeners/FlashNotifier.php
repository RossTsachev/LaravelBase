<?php

namespace MyLibrary\Listeners;

use MyLibrary\Author\AuthorWasStored;
use MyLibrary\Author\AuthorWasEdited;
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
}
