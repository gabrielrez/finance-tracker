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



    public function update()
    {
        $attributes = request()->validate([
            'username' => ['required', 'string', 'max:28']
        ]);

        user()->username = $attributes['username'];
        user()->save();

        return redirect()->back();
    }
}
