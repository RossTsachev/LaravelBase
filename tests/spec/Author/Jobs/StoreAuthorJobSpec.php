<?php

namespace tests\spec\MyLibrary\Author\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StoreAuthorJobSpec extends ObjectBehavior
{
    private $id;
    private $name;

    public function let()
    {
        $this->id = 1;
        $this->name = "John Doe";
        $this->beConstructedWith($this->id, $this->name);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Jobs\StoreAuthorJob');
    }
}
