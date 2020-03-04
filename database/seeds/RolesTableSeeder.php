<?php

use Illuminate\Database\Seeder;
use App\Entity\User\User;
use App\Entity\User\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (Role::count() != 0) {
            throw new Exception(Role::getTableName() . ' table is not empty. Truncate all tables!');
        }

        $roles = [
            'Admin',
            'Moderator'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
