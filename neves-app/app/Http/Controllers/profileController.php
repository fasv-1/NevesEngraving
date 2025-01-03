<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Sanctum\HasApiTokens;

class ProfileController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct()
{
    $this->middleware(['role:User|Admin|Super-Admin']);
}
       /**
     * Display the user's profile form.
     */
    public function edit(){
        $user = Auth::user();

        $tokenResult = $user->createToken('Personal Access Token', ['Profile-acess']);

         $token = $tokenResult->plainTextToken;



        return view('profile', ['user' => $user, 'token' => $token]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
