<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use App\Entity\User\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (Permission::count() != 0) {
            throw new Exception(Permission::getTableName() . ' table is not empty. Stop all seeds!!!');
        }

        $permissions = [
            'SHOW_USERS',
            'EDIT_USERS',
            'SHOW_PERMISSIONS',
            'EDIT_PERMISSIONS'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
