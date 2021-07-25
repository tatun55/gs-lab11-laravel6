<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\User;
use App\UserProfile;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('me', compact('user'));
    }

    public function upsert(UserProfileRequest $request, User $user)
    {
        UserProfile::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            $request->all(),
        );
        return redirect('me');
    }
}