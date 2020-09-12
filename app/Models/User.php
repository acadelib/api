<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the user's profiles.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProfilesAttribute()
    {
        $profiles = collect();
        $profiles->put('teachers', $this->teachers);
        $profiles->put('students', $this->students);

        return $profiles;
    }

    /**
     * Get the user's profile.
     *
     * @return mixed
     */
    public function getProfileAttribute()
    {
        return $this->profiles->flatten()->first(function ($profile) {
            return decrypt($profile->identifier) == decrypt($this->profile_identifier);
        });
    }

    /**
     * A user may have many teacher profiles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * A user may have many student profiles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
