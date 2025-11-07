<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'invite.send',
            'invite.resend',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

       
        $admin->givePermissionTo($permissions);
        $user->revokePermissionTo($permissions); 
    
    }
}
