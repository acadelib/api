<?php

namespace App\Traits;

use App\Models\Role;

trait HasRoles
{
    /**
     * A profile may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Determine if the profile has the given role.
     *
     * @param  string|\App\Models\Role  $role
     * @return bool
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            $role = Role::findByName($role);
        }

        return $this->roles->contains($role);
    }

    /**
     * Assign the given role to the profile.
     *
     * @param  string|\App\Models\Role  $role
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::findByName($role);
        }

        return $this->roles()->save($role);
    }

    /**
     * Remove the given role from the profile.
     *
     * @param  string|\App\Models\Role  $role
     * @return int
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::findByName($role);
        }

        return $this->roles()->detach($role);
    }
}
