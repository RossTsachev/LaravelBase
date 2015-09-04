<?php

namespace MyLibrary\Book\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use MyLibrary\Book\Models\Book;

;

class StoreBookJob extends Job implements SelfHandling
{
    public $title;
    public $authors;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $authors)
    {
        $this->title = $title;
        $this->authors = $authors;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Book $book)
    {
        $book->store($this->title, $this->authors);
    }
}
