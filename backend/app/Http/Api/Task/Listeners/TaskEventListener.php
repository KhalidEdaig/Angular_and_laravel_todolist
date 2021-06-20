<?php

namespace App\Http\Api\Task\Listeners;


class BookEventListener
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Http\Api\Task\Events\TaskWasCreated',
            'App\Http\Api\Task\Listeners\TaskEventListener@onTaskWasCreated'
        );

        $events->listen(
            'App\Http\Api\Task\Events\BookWasUpdated',
            'App\Http\Api\Task\Listeners\TaskEventListener@onTaskWasUpdated'
        );
    }

    /**
     * Handle task created events.
     */
    public function onTaskWasCreated($event)
    {
        dd($event);
    }

    /**
     * Handle task updated events.
     */
    public function onTaskWasUpdated($event)
    {
        dd($event);
    }
}
