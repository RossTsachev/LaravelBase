<?php

namespace MyLibrary\Author\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use MyLibrary\Author\Models\AuthorRepositoryInterface;

;

class StoreAuthorJob extends Job implements SelfHandling
{
    public $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AuthorRepositoryInterface $author)
    {
        $author->store($this->name);
    }
}
