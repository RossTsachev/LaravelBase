<?php

namespace tests\spec\MyLibrary\Book\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Book\Models\Book;

class BookRepositorySpec extends ObjectBehavior
{
    public function let(Book $book)
    {
        $this->beConstructedWith($book);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Models\BookRepository');
    }
}
