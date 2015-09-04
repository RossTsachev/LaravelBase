<?php

namespace MyLibrary\Author\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use MyLibrary\Author\Models\Author;

;

class UpdateAuthorJob extends Job implements SelfHandling
{
    public $id;
    public $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Author $author)
    {
        $author->edit($this->id, $this->name);
    }
}
