<?php
/*
 * Acadelib - Outil de gestion d'établissements scolaires libre et gratuit
 * Copyright (C) 2022 Samuel Maurice
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

use App\Models\Profile;
use App\Models\School;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasProfileAttributes
{
    /**
     * A profile is linked to a school.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * A profile may be attached to a user account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
