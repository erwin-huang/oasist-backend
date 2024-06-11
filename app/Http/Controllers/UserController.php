<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the authenticated user.
     */
    public function me(Request $request) {
        return $request->user();
    }
}
