<?php

namespace App\Models;

use App\Exceptions\PermissionNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * A permission may be given to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * A permission may be given to many profiles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Find a permission by its name.
     *
     * @param  string  $name
     * @return \App\Models\Permission
     *
     * @throws \App\Exceptions\PermissionNotFoundException
     */
    public static function findByName($name)
    {
        $permission = static::whereName($name)->first();

        if (! $permission) {
            throw new PermissionNotFoundException;
        }

        return $permission;
    }
}
