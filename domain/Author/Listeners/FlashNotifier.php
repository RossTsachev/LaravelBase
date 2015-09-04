<?php

namespace MyLibrary\Author\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use MyLibrary\Author\Events\AuthorWasStored;
use MyLibrary\Author\Events\AuthorWasEdited;

use Session;

class FlashNotifier
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AuthorWasStored  $event
     * @return void
     */
    public function handleStorage($event)
    {
        Session::flash('flash-message', 'The author was saved.');
    }

     /**
     * Handle the event.
     *
     * @param  AuthorWasEdited  $event
     * @return void
     */
    public function handleEdition($event)
    {
        Session::flash('flash-message', 'The author was edited.');
    }

    public function subscribe($events)
    {
        $events->listen(
            'MyLibrary\Author\Events\AuthorWasStored',
            'MyLibrary\Author\Listeners\FlashNotifier@handleStorage'
        );

        $events->listen(
            'MyLibrary\Author\Events\AuthorWasEdited',
            'MyLibrary\Author\Listeners\FlashNotifier@handleEdition'
        );
    }
}
