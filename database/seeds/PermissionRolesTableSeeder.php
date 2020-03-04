<?php

use App\Entity\User\PermissionRoles;
use App\Entity\User\Role;
use Illuminate\Database\Seeder;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (PermissionRoles::count() !== 0) {
            throw new Exception(PermissionRoles::getTableName() . ' table is not empty. Stop all seeds!!!');
        }

        // Admin
        Role::find(1)->rPermissions()->sync([
            1 => [ 'test' => 'test1' ],
            2 => [ 'test' => 'test2' ]
        ]);
        // Moderator
        Role::find(2)->rPermissions()->sync([
            3 => [ 'test' => 'test3' ],
            4 => [ 'test' => 'test4' ]
        ]);


    }
}
