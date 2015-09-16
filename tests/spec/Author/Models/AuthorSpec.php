<?php

namespace tests\spec\MyLibrary\Author\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Models\Author');
    }
}
