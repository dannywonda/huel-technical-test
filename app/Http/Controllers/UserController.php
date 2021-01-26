<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a view of the users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return UserResource::collection(User::all());
    }
}
