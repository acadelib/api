<?php

namespace App\Models;

use App\Exceptions\RoleNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * A role may be assigned to many profiles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Find a role by its name.
     *
     * @param  string  $name
     * @return \App\Models\Role
     *
     * @throws \App\Exceptions\RoleNotFoundException
     */
    public static function findByName($name)
    {
        $role = static::whereName($name)->first();

        if (! $role) {
            throw new RoleNotFoundException;
        }

        return $role;
    }
}
