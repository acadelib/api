<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any classrooms.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->profile->hasRole('administrator');
    }

    /**
     * Determine whether the user can view the classroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classroom  $classroom
     * @return bool
     */
    public function view(User $user, Classroom $classroom)
    {
        return $user->profile->hasRole('administrator') && ($user->profile->profileable->school_id == $classroom->school->id);
    }

    /**
     * Determine whether the user can create classrooms.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->profile->hasRole('administrator');
    }

    /**
     * Determine whether the user can update the classroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classroom  $classroom
     * @return bool
     */
    public function update(User $user, Classroom $classroom)
    {
        return $user->profile->hasRole('administrator') && ($user->profile->profileable->school_id == $classroom->school->id);
    }

    /**
     * Determine whether the user can delete the classroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classroom  $classroom
     * @return bool
     */
    public function delete(User $user, Classroom $classroom)
    {
        return $user->profile->hasRole('administrator') && ($user->profile->profileable->school_id == $classroom->school->id);
    }
}
