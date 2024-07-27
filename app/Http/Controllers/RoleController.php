<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();

        return view('roles.index', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|unique:roles,name',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $role = Role::create([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'status'=> 200,
                'message'=> 'Role Added Successfully.'
            ]);
        }
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        if($role) {
            return response()->json([
                'status' => 200,
                'role' => $role,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Role Found.'
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3','max:50', Rule::unique(Role::class)->ignore(app('request')->segment(2))],
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $role = Role::findOrFail($id);
            if ($role) {
                $role->update([
                    'name' => $request->input('name'),
                ]);

                return response()->json([
                    'status'=> 200,
                    'message'=> 'Role Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status'=> 404,
                    'errors'=> 'No Role Found'
                ]);
            }
        }
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if($role) {
            $role->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Role Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Role Found.'
            ]);
        }
    }
}
