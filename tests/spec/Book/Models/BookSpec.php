<?php

namespace tests\spec\MyLibrary\Book\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Models\Book');
    }
}
