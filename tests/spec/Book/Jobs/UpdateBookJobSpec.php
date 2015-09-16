<?php

namespace tests\spec\MyLibrary\Book\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateBookJobSpec extends ObjectBehavior
{
    private $id;
    private $title;
    private $authors;

    public function let()
    {
        $this->id = 1;
        $this->title = "Just a title";
        $this->authors = ["Stephen King", "Dean Kuntz"];
        $this->beConstructedWith($this->id, $this->title, $this->authors);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Jobs\UpdateBookJob');
    }
}
