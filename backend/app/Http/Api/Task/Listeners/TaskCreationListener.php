<?php

namespace App\Http\Api\Task\Listeners;

use App\Http\Api\Task\Events\TaskWasCreated;

class TaskCreationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TaskWasCreated $event
     *
     * @return void
     */
    public function handle(TaskWasCreated $event)
    {
        //
    }
}
