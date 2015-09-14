<?php

namespace tests\spec\MyLibrary\Post\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Post\Models\PostRepositoryInterface;

class PostWasStoredSpec extends ObjectBehavior
{
    public function let(PostRepositoryInterface $post)
    {
        $this->beConstructedWith($post);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Post\Events\PostWasStored');
    }
}
