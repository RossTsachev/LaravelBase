<?php

namespace tests\spec\MyLibrary\Author\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Author\Models\Author;

class AuthorRepositorySpec extends ObjectBehavior
{
    public function let(Author $author)
    {
        $this->beConstructedWith($author);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Models\AuthorRepository');
        $this->shouldImplement('MyLibrary\Author\Models\AuthorRepositoryInterface');
    }
}
