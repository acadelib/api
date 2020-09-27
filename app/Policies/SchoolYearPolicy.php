<?php

namespace App\Policies;

use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolYearPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any school years.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->profile->hasRole('administrator');
    }

    /**
     * Determine whether the user can view the school year.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return bool
     */
    public function view(User $user, SchoolYear $schoolYear)
    {
        return $user->profile->hasRole('administrator') && ($user->profile->profileable->school_id == $schoolYear->school_id);
    }

    /**
     * Determine whether the user can create school years.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->profile->hasRole('administrator');
    }

    /**
     * Determine whether the user can update the school year.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return bool
     */
    public function update(User $user, SchoolYear $schoolYear)
    {
        return $user->profile->hasRole('administrator') && ($user->profile->profileable->school_id == $schoolYear->school_id);
    }

    /**
     * Determine whether the user can delete the school year.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return bool
     */
    public function delete(User $user, SchoolYear $schoolYear)
    {
        return $user->profile->hasRole('administrator') && ($user->profile->profileable->school_id == $schoolYear->school_id);
    }
}
