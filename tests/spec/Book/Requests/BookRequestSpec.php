<?php

namespace tests\spec\MyLibrary\Book\Requests;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BookRequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Requests\BookRequest');
    }
}
