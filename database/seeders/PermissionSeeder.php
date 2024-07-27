<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create([
            'name' => 'menu posts',
            'group_name' => 'posts'
        ]);

        Permission::create([
            'name' => 'all posts',
            'group_name' => 'posts'
        ]);

        Permission::create([
            'name' => 'add post',
            'group_name' => 'posts'
        ]);

        Permission::create([
            'name' => 'edit post',
            'group_name' => 'posts'
        ]);

        Permission::create([
            'name' => 'delete post',
            'group_name' => 'posts'
        ]);

        Permission::create([
            'name' => 'menu categories',
            'group_name' => 'categories'
        ]);

        Permission::create([
            'name' => 'all categories',
            'group_name' => 'categories'
        ]);

        Permission::create([
            'name' => 'add category',
            'group_name' => 'categories'
        ]);

        Permission::create([
            'name' => 'edit category',
            'group_name' => 'categories'
        ]);

        Permission::create([
            'name' => 'delete category',
            'group_name' => 'categories'
        ]);

        Permission::create([
            'name' => 'menu tags',
            'group_name' => 'tags'
        ]);

        Permission::create([
            'name' => 'all tags',
            'group_name' => 'tags'
        ]);

        Permission::create([
            'name' => 'add tag',
            'group_name' => 'tags'
        ]);

        Permission::create([
            'name' => 'edit tag',
            'group_name' => 'tags'
        ]);

        Permission::create([
            'name' => 'delete tag',
            'group_name' => 'tags'
        ]);

        Permission::create([
            'name' => 'menu comments',
            'group_name' => 'comments'
        ]);

        Permission::create([
            'name' => 'all comments',
            'group_name' => 'comments'
        ]);

        Permission::create([
            'name' => 'add comment',
            'group_name' => 'comments'
        ]);

        Permission::create([
            'name' => 'edit comment',
            'group_name' => 'comments'
        ]);

        Permission::create([
            'name' => 'delete comment',
            'group_name' => 'comments'
        ]);

        Permission::create([
            'name' => 'menu users',
            'group_name' => 'users'
        ]);

        Permission::create([
            'name' => 'all users',
            'group_name' => 'users'
        ]);

        Permission::create([
            'name' => 'add user',
            'group_name' => 'users'
        ]);

        Permission::create([
            'name' => 'edit user',
            'group_name' => 'users'
        ]);

        Permission::create([
            'name' => 'delete user',
            'group_name' => 'users'
        ]);
    }
}
