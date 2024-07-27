<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);

        if (auth()->user()->id !== $user->id) {
            abort(403);
        }

        return view('profile.show', ['user' => $user]);
    }

    public function changePassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate(
            [
                'old_password' => ['required',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!Hash::check($value, $user->password)) {
                            $fail('The current password does not match together.');
                        }
                    }
                ],
                'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
            ],
            [
                'old_password.required' => 'Enter the password',
                'new_password.required' => 'Enter the new password',
                'new_password.string' => 'The password must consist of letters only',
                'new_password.min' => 'The value must not be less than 8',
                'new_password.confirmed' => 'The password does not match.',
                'new_password.different' => 'Same as your current password.',
            ]
        );

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.show', ['profile' => $user->id])
            ->with('success', 'The password has been modified successfully');
    }
}
