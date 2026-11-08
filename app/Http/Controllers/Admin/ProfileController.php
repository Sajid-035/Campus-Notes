<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('backend.profile.show', compact('user'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('backend.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if (!$file->isValid()) {
                return back()->withErrors(['avatar' => 'The profile image could not be uploaded. Please choose it again.'])->withInput();
            }

            $avatarDirectory = public_path('uploads/avatars');
            File::ensureDirectoryExists($avatarDirectory);
            $filename = Str::uuid() . '.' . strtolower($file->extension() ?: $file->getClientOriginalExtension());
            $file->move($avatarDirectory, $filename);

            if (!is_file($avatarDirectory . DIRECTORY_SEPARATOR . $filename)) {
                return back()->withErrors(['avatar' => 'Could not save the image. Check write permission for public/uploads/avatars.'])->withInput();
            }

            $oldAvatar = $user->avatar;
            $user->avatar = $filename;
            $oldAvatarFilename = $oldAvatar ? basename(str_replace('\\', '/', $oldAvatar)) : null;
            if ($oldAvatarFilename && $oldAvatarFilename !== $filename && is_file($avatarDirectory . DIRECTORY_SEPARATOR . $oldAvatarFilename)) {
                @unlink($avatarDirectory . DIRECTORY_SEPARATOR . $oldAvatarFilename);
            }
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
