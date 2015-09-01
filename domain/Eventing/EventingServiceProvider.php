<?php

namespace MyLibrary\Eventing;

use Illuminate\Support\ServiceProvider;

class EventingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $listeners = $this->app['config']->get('myLibrary.listeners');

        foreach ($listeners as $listener) {
            $this->app['events']->listen('MyLibrary.*', $listener);
        }
    }
}
