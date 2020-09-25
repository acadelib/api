<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrator extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * An administrator is linked to a school.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * An administrator may be attached to a user account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
