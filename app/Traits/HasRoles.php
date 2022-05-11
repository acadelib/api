<?php
/**
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

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * A profile may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Determine if a profile has the given role.
     *
     * @param  string|\App\Models\Role  $role
     * @return bool
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public function hasRole(string|Role $role): bool
    {
        if (is_string($role)) {
            $role = Role::findByName($role);
        }

        return $this->roles->contains($role);
    }

    /**
     * Assign the given role to a profile.
     *
     * @param  string|\App\Models\Role  $role
     * @return $this
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public function assignRole(string|Role $role): static
    {
        if (is_string($role)) {
            $role = Role::findByName($role);
        }

        $this->roles()->attach($role);

        return $this;
    }

    /**
     * Remove the given role from a profile.
     *
     * @param  string|\App\Models\Role  $role
     * @return $this
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public function removeRole(string|Role $role): static
    {
        if (is_string($role)) {
            $role = Role::findByName($role);
        }

        $this->roles()->detach($role);

        return $this;
    }
}
