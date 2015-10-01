<?php

namespace tests\spec\MyLibrary\Author\Listeners;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use PhpSpec\Laravel\LaravelObjectBehavior;

// use MyLibrary\Author\Events\AuthorWasStored;
// use Illuminate\Session\Store as Session;

class FlashNotifierSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Listeners\FlashNotifier');
    }

    
    // function it_handles_author_storage(AuthorWasStored $event, Session $session)
    // {
    //     $this->handleStorage($event);
    //     $session->flash()->shouldHaveBeenCalled();
    // }
}
