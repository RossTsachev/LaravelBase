<?php

namespace tests\spec\MyLibrary\Book\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Book\Models\BookRepositoryInterface;

class BookWasEditedSpec extends ObjectBehavior
{
    public function let(BookRepositoryInterface $book)
    {
        $this->beConstructedWith($book);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Events\BookWasEdited');
    }
}
