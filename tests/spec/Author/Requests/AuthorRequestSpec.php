<?php

namespace tests\spec\MyLibrary\Author\Requests;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthorRequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Requests\AuthorRequest');
    }
}
