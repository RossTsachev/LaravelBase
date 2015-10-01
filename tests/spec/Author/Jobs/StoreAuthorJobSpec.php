<?php

namespace tests\spec\MyLibrary\Author\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Author\Models\AuthorRepositoryInterface;

class StoreAuthorJobSpec extends ObjectBehavior
{
    private $name = "John Doe";

    public function let()
    {
        $this->beConstructedWith($this->name);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Author\Jobs\StoreAuthorJob');
    }

    function it_processes_the_storage_of_the_author(AuthorRepositoryInterface $author)
    {
        $this->handle($author);
        $author->store($this->name)->shouldHaveBeenCalled();
    }
}
