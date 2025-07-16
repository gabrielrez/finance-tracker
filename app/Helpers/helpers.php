<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('user')) {
    /**
     * Get the currently authenticated user instance or null if not authenticated.
     * 
     * @return \App\Models\User|null
     */
    function user(): ?App\Models\User
    {
        return Auth::user() ?? null;
    }
}
