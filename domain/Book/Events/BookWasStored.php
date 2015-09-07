<?php

namespace MyLibrary\Book\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use MyLibrary\Book\Models\BookRepositoryInterface;

class BookWasStored extends Event
{
    use SerializesModels;

    public $book;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->book = $bookRepo->book;
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
