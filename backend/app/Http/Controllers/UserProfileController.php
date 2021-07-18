<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('me', compact('user'));
    }

    public function upsert(Request $request, User $user)
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