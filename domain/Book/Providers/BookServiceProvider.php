<?php

namespace MyLibrary\Book\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class BookServiceProvider extends ServiceProvider
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
        'MyLibrary\Book\Listeners\FlashNotifier',
    ];

    /**
     * binding the reporsitory interface
     */
    public function register()
    {
        $this->app->bind(
            'MyLibrary\Book\Models\BookRepositoryInterface',
            'MyLibrary\Book\Models\BookRepository'
        );
    }
}
