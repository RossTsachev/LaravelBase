<?php

namespace MyLibrary\Post\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use MyLibrary\Post\Models\Post;

;

class StorePostJob extends Job implements SelfHandling
{
    public $userId;
    public $bookId;
    public $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $bookId, $post)
    {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Post $post)
    {
        $post->store(
            $this->userId,
            $this->bookId,
            $this->post
        );
    }
}
