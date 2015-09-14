<?php

namespace tests\spec\MyLibrary\Post\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MyLibrary\Post\Models\Post;

class PostRepositorySpec extends ObjectBehavior
{
    public function let(Post $post)
    {
        $this->beConstructedWith($post);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('MyLibrary\Post\Models\PostRepository');
    }
}
