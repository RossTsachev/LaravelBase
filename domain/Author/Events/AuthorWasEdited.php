<?php

namespace MyLibrary\Author\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use MyLibrary\Author\Models\AuthorRepositoryInterface;

class AuthorWasEdited extends Event
{
    use SerializesModels;

    public $author;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AuthorRepositoryInterface $author)
    {
        $this->author = $author;
    }
}
