<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    public static function getPermissionGroup()
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name')
            ->groupBy('group_name')
            ->get();

        return $permission_groups;
    }

    public static function getPermissionByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('id', 'name')
            ->where('group_name', $group_name)
            ->get();

        return $permissions;
    }

    public function scopeFilter($query)
    {
        if (request('search_text')) {
            $query->where('name', 'like', '%' . request('search_text') . '%');
        }

        return $query;
    }
}
