<?php

namespace tests\spec\MyLibrary\Post\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StorePostJobSpec extends ObjectBehavior
{
    private $userId;
    private $bookId;
    private $post;

    public function let()
    {
        $this->userId = 1;
        $this->bookId = 1;
        $this->post = "My first post.";
        $this->beConstructedWith($this->userId, $this->bookId, $this->post);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Post\Jobs\StorePostJob');
    }
}
