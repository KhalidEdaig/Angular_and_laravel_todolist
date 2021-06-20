<?php

namespace App\Http\Api\Task;

use App\Models\Task;
use App\Models\User;
use App\Policies\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $this->ifAdmin($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        return $this->ifUser($user);
    }

    /**
     * Determine if the given user can create the given resource.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $this->ifAdmin($user);
    }

    /**
     * Determine if the given user can edit the given resource.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function edit(User $user, Task $task)
    {
        return $this->ifAdmin($user);
    }

    /**
     * Determine if the given user can destroy the given resource.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        return $this->ifAdmin($user);
    }
}
