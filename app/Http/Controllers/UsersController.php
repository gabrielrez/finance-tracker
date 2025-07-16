<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function updateProfilePicture()
    {
        request()->validate([
            'profile_picture' => 'required|string',
        ]);

        $user = user();
        $user->profile_picture = request()->input('profile_picture');
        $user->save();

        return redirect()->back();
    }
}
