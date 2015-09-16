<?php

namespace tests\spec\MyLibrary\Post\Listeners;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlashNotifierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Post\Listeners\FlashNotifier');
    }
}
