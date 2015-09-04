<?php

namespace MyLibrary\Author\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use MyLibrary\Author\Models\Author;

class AuthorWasEdited extends Event
{
    use SerializesModels;

    public $author;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
