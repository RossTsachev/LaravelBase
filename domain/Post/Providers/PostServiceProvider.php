<?php

namespace MyLibrary\Post\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'MyLibrary\Post\Listeners\FlashNotifier',
    ];

    /**
     * binding the reporsitory interface
     */
    public function register()
    {
        $this->app->bind(
            'MyLibrary\Post\Models\PostRepositoryInterface',
            'MyLibrary\Post\Models\PostRepository'
        );
    }
}
