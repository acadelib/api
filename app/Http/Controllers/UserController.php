<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Return the user's details.
     *
     * @return \App\Http\Resources\User
     */
    public function index()
    {
        return new UserResource(auth()->user());
    }
}
