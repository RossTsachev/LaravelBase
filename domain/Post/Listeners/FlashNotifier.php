<?php

namespace MyLibrary\Post\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use MyLibrary\Post\Events\PostWasStored;
use MyLibrary\Post\Events\PostWasEdited;

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
     * @param  PostWasStored  $event
     * @return void
     */
    public function handleStorage($event)
    {
        Session::flash('flash-message', 'The post was saved.');
    }

    public function subscribe($events)
    {
        $events->listen(
            'MyLibrary\Post\Events\PostWasStored',
            'MyLibrary\Post\Listeners\FlashNotifier@handleStorage'
        );
    }
}
