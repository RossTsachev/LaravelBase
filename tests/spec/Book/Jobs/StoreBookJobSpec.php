<?php

namespace tests\spec\MyLibrary\Book\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StoreBookJobSpec extends ObjectBehavior
{
    private $title;
    private $authors;

    public function let()
    {
        $this->title = "Just a title";
        $this->authors = ["Stephen King", "Dean Kuntz"];
        $this->beConstructedWith($this->title, $this->authors);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Book\Jobs\StoreBookJob');
    }
}
