<?php

namespace MyLibrary\Book\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use MyLibrary\Book\Models\BookRepositoryInterface;

;

class UpdateBookJob extends Job implements SelfHandling
{
    public $id;
    public $title;
    public $authors;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $title, $authors)
    {
        $this->id = $id;
        $this->title = $title;
        $this->authors = $authors;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BookRepositoryInterface $book)
    {
        $book->edit($this->id, $this->title, $this->authors);
    }
}
