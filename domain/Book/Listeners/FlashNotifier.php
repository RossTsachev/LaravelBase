<?php

namespace MyLibrary\Book\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use MyLibrary\Book\Events\BookWasStored;
use MyLibrary\Book\Events\BookWasEdited;

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
     * @param  BookWasStored  $event
     * @return void
     */
    public function handleStorage($event)
    {
        Session::flash('flash-message', 'The book was saved.');
    }

     /**
     * Handle the event.
     *
     * @param  BookWasEdited  $event
     * @return void
     */
    public function handleEdition($event)
    {
        Session::flash('flash-message', 'The book was edited.');
    }

    public function subscribe($events)
    {
        $events->listen(
            'MyLibrary\Book\Events\BookWasStored',
            'MyLibrary\Book\Listeners\FlashNotifier@handleStorage'
        );

        $events->listen(
            'MyLibrary\Book\Events\BookWasEdited',
            'MyLibrary\Book\Listeners\FlashNotifier@handleEdition'
        );
    }
}
