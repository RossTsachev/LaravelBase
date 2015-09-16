<?php

namespace tests\spec\MyLibrary\Book\Listeners;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlashNotifierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Listeners\FlashNotifier');
    }
}
