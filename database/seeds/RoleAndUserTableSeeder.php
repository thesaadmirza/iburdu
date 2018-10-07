<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;

class RoleAndUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('users')->delete();
        DB::table('permission_role')->delete();
        DB::table('role_user')->delete();
        // Create Roles
        $subscriberRole = Role::create([
            'name' => 'subscriber',
            'slug' => 'subscriber',
        ]);
        $contributorRole = Role::create([
            'name' => 'contributor',
            'slug' => 'contributor',
        ]);
        $authorRole = Role::create([
            'name' => 'author',
            'slug' => 'author',
        ]);
        $editorRole = Role::create([
            'name' => 'editor',
            'slug' => 'editor',
        ]);
        $adminRole = Role::create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);
        // Create Permission
        $createArticlePermission = Permission::create([
            'name' => 'Post Article',
            'slug' => 'article.create',
        ]);
        $uploadImagePermission = Permission::create([
            'name' => 'Image Upload',
            'slug' => 'image.upload',
        ]);
        $manageArticlePermission = Permission::create([
            'name' => 'Article management',
            'slug' => 'article.manage',
        ]);
        $manageImagePermission = Permission::create([
            'name' => 'Picture management',
            'slug' => 'image.manage',
        ]);
        $manageUserPermission = Permission::create([
            'name' => 'User Management',
            'slug' => 'user.manage',
        ]);
        $manageSystemPermission = Permission::create([
            'name' => 'System settings',
            'slug' => 'system.manage',
        ]);

        $contributorRole->assignPermission($createArticlePermission->id);

        $authorRole->assignPermission($createArticlePermission->id);
        $authorRole->assignPermission($uploadImagePermission->id);

        $editorRole->assignPermission($createArticlePermission->id);
        $editorRole->assignPermission($uploadImagePermission->id);
        $editorRole->assignPermission($manageArticlePermission->id);
        $editorRole->assignPermission($manageImagePermission->id);

        // Create User
        $admin = User::create([
            'name' => env('ADMIN_NAME', 'Admin'),
            'email' => env('ADMIN_EMAIL', 'admin@laravel.blog'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password'))
        ]);
        if(! $admin->save()) {
            Log::info('Unable to create admin '.$admin->username, (array)$admin->errors());
        } else {
            $admin->assignRole($adminRole->id);
            Log::info('Created admin "'.$admin->username.'" <'.$admin->email.'>');
        }
    }
}
