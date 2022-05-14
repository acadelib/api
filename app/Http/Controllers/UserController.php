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

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Return the user's details.
     *
     * @return \App\Http\Resources\UserResource
     */
    public function index(): UserResource
    {
        return new UserResource(Auth::user());
    }
}
