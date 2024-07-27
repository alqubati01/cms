<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $permissions = Permission::filter()->paginate(10);
        $data = $request->all();

        return view('permissions.index', ['permissions' => $permissions, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|unique:permissions,name',
            'group_name' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $permission = Permission::create([
                'name' => $request->input('name'),
                'group_name' => $request->input('group_name'),
            ]);

            return response()->json([
                'status'=> 200,
                'message'=> 'Permission Added Successfully.'
            ]);
        }
    }

    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);

        if($permission) {
            return response()->json([
                'status' => 200,
                'permission' => $permission,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Permission Found.'
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3','max:50', Rule::unique(Permission::class)->ignore(app('request')->segment(2))],
            'group_name' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $permission = Permission::findOrFail($id);
            if ($permission) {
                $permission->update([
                    'name' => $request->input('name'),
                    'group_name' => $request->input('group_name'),
                ]);

                return response()->json([
                    'status'=> 200,
                    'message'=> 'Permission Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status'=> 404,
                    'errors'=> 'No Permission Found'
                ]);
            }
        }
    }

    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);

        if($permission) {
            $permission->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Permission Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Permission Found.'
            ]);
        }
    }
}
