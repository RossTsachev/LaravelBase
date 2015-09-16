<?php

namespace tests\spec\MyLibrary\Post\Requests;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostRequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Post\Requests\PostRequest');
    }
}
