<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);

//        if (auth()->user()->id !== $user->id) {
//            abort(403);
//        }

        return response()->json($user, 200);
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

        return response()->json($user, 200);
    }
}
