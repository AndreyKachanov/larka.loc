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
     */
    public function run()
    {
        $permissions = [
            'Admin',
            'Moderator',
            'User'
        ];

        if (App::environment('local')) {
            if (Permission::count() == 0) {
                foreach ($permissions as $permission) {
                    Permission::create(['name' => $permission]);
                }
            }
        }
    }
}
