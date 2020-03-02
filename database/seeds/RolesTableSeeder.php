<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use App\Entity\User\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin',
            'Moderator',
            'User'
        ];

        if (App::environment('local')) {
            if (Role::count() == 0) {
                foreach ($roles as $role) {
                    Role::create(['name' => $role]);
                }
            }
        }
    }
}
