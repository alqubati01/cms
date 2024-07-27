<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::where('role', 'admin')->filter()->orderBy('id')->paginate(10);
        $data = $request->all();

        return view('users.index', ['users' => $users, 'data' => $data]);
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['role'] = 'admin';
        $validated['password'] = Hash::make($request->password);
        $user = User::create($validated);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files');
            $user->image()->save(
                Image::make([
                    'path' => $path,
                ])
            );
        }

        if ($request->role) {
            $user->assignRole((int) $request->role);
        }

        return redirect()->route('users.index')
            ->with('success', 'User was created successfully');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.show', ['user' => $user]);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
        $validated['is_active'] = $request->status;
        $validated['role'] = 'admin';
        $user->fill($validated);
        $user->save();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files');

            if ($user->image) {
                Storage::delete($user->image->path);
                $user->image->path = $path;
                $user->image->save();
            } else {
                $user->image()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );
            }
        }

        if ($request->role) {
            $user->assignRole((int) $request->role);
        }

        return redirect()->route('users.index')
            ->with('success', 'User was update successfully');
    }

    public function changePassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'The user\'s password has been successfully modified');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if($user) {
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'User Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No User Found.'
            ]);
        }
    }
}
