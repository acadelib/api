<?php

namespace App\Traits;

use App\Models\Permission;

trait HasPermissions
{
    /**
     * A role or a profile may be given many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Determine if a role or a profile has the given permission.
     *
     * @param  string|\App\Models\Permission  $permission
     * @return bool
     *
     * @throws \App\Exceptions\PermissionNotFoundException
     */
    public function hasPermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        return $this->hasDirectPermission($permission) || $this->hasPermissionViaRole($permission);
    }

    /**
     * Determine if a role or a profile has the given permission directly.
     *
     * @param  \App\Models\Permission  $permission
     * @return bool
     */
    private function hasDirectPermission($permission)
    {
        return $this->permissions->contains($permission);
    }

    /**
     * Determine if a profile has the given permission via a role.
     *
     * @param  \App\Models\Permission  $permission
     * @return bool
     */
    private function hasPermissionViaRole($permission)
    {
        return $permission->roles->intersect($this->roles)->isNotEmpty();
    }

    /**
     * Grant the given permission to a role or a profile.
     *
     * @param  string|\App\Models\Permission  $permission
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \App\Exceptions\PermissionNotFoundException
     */
    public function givePermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        return $this->permissions()->save($permission);
    }

    /**
     * Revoke the given permission from a role or a profile.
     *
     * @param  string|\App\Models\Permission  $permission
     * @return int
     *
     * @throws \App\Exceptions\PermissionNotFoundException
     */
    public function revokePermissionTo($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        return $this->permissions()->detach($permission);
    }
}
