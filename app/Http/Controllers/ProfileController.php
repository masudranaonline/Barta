<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{

    public function index()
    {

    //    return  User::with(['media'])->find(Auth::id());
        return view('profile');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, string $username)
    {
        // return Auth::user()->with('media');
         $user = User::with('media')->where('username', $username)->first();

        return view('profile_edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */

     public function show(string $id)
     {
        return $user = User::with('media')->where('id', $id)->first();
     }
    public function update(ProfileUpdateRequest $request, string $id): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }


        try {
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->bio = $request->bio;

            $user->save();

        //    return User::with('media')->where('id', $id);

            // return $user;

            // return Redirect::route('profile.edit')->with('status', 'profile-updated');


            return back()->with('success','User Updated Successfully');
        } catch (\Throwable $th) {
            throw $th;
        }


        // $request->user()->save();

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
