<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:50',
            'tiktok' => 'nullable|string|max:50',
            'mata_pelajaran' => 'nullable|string|max:100',
        ]);

        // Handle Upload Avatar
        if ($request->hasFile('avatar')) {

            // Hapus foto lama jika ada
            if ($user->avatar && Storage::disk('public')->exists('avatars/'.$user->avatar)) {
                Storage::disk('public')->delete('avatars/'.$user->avatar);
            }

            // Simpan file baru ke storage/app/public/avatars
            $fileName = time().'_'.$user->id.'.'.$request->avatar->extension();
            $request->avatar->storeAs('avatars', $fileName, 'public');

            $user->avatar = $fileName;
        }

        // Update field lainnya
        $user->fill($request->only([
            'name',
            'email',
            'bio',
            'phone',
            'instagram',
            'tiktok',
            'mata_pelajaran'
        ]));

        $user->save();

        return back()->with('status', 'profile-updated');
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