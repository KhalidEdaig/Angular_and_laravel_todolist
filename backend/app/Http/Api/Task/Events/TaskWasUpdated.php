<?php

namespace App\Http\Api\Task\Events;

use App\Events\Event;
use App\Models\Task;
use Illuminate\Queue\SerializesModels;

class TaskWasUpdated extends Event
{
    use SerializesModels;

    public $task;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
