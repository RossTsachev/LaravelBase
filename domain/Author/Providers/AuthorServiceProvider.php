<?php

namespace MyLibrary\Author\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AuthorServiceProvider extends ServiceProvider
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
        'MyLibrary\Author\Listeners\FlashNotifier',
    ];

    /**
     * binding the reporsitory interface
     */
    public function register()
    {
        $this->app->bind(
            'MyLibrary\Author\Models\AuthorRepositoryInterface',
            'MyLibrary\Author\Models\AuthorRepository'
        );
    }
}
