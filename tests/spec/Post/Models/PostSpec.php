<?php

namespace tests\spec\MyLibrary\Post\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Post\Models\Post');
    }
}
