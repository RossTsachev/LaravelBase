<?php

namespace tests\spec\MyLibrary\Author\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Author\Models\AuthorRepositoryInterface;

class AuthorWasStoredSpec extends ObjectBehavior
{
    public function let(AuthorRepositoryInterface $author)
    {
        $this->beConstructedWith($author);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Events\AuthorWasStored');
    }
}
