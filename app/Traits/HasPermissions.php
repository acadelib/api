<?php
/*
 * Acadelib - Outil de gestion d'établissements scolaires libre et gratuit
 * Copyright (C) 2020 - 2022 Samuel Maurice
 *
 * This file is part of Acadelib.
 *
 * Acadelib is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Acadelib is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Acadelib. If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Traits;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions
{
    /**
     * A role or a profile may be given many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
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
    public function hasPermissionTo(string|Permission $permission): bool
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
    private function hasDirectPermission(Permission $permission): bool
    {
        return $this->permissions->contains($permission);
    }

    /**
     * Determine if a profile has the given permission via a role.
     *
     * @param  \App\Models\Permission  $permission
     * @return bool
     */
    private function hasPermissionViaRole(Permission $permission): bool
    {
        if ($this instanceof Profile) {
            return $permission->roles->intersect($this->roles)->isNotEmpty();
        }

        return false;
    }

    /**
     * Grant the given permission to a role or a profile.
     *
     * @param  string|\App\Models\Permission  $permission
     * @return $this
     *
     * @throws \App\Exceptions\PermissionNotFoundException
     */
    public function givePermissionTo(string|Permission $permission): static
    {
        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        $this->permissions()->attach($permission);

        return $this;
    }

    /**
     * Revoke the given permission from a role or a profile.
     *
     * @param  string|\App\Models\Permission  $permission
     * @return $this
     *
     * @throws \App\Exceptions\PermissionNotFoundException
     */
    public function revokePermissionTo(string|Permission $permission): static
    {
        if (is_string($permission)) {
            $permission = Permission::findByName($permission);
        }

        $this->permissions()->detach($permission);

        return $this;
    }
}
