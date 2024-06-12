<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Display the authenticated user.
     */
    public function me(Request $request) {
        try {
            return $request->user();
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
