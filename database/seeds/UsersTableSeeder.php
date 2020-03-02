<?php

use Illuminate\Database\Seeder;
use App\Entity\User\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (App::environment('local')) {
            if (User::count() == 0) {
                User::create([
                    'email'             => 'test@test.loc',
                    'name'              => 'Иван Иванов',
                    //'last_name'         => 'Testov',
                    'phone'             => '380997111111',
                    'phone_auth'        => false,
                    'phone_verified'    => false,
                    'email_verified_at' => Carbon::now(),
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                    'status'            => User::STATUS_ACTIVE,
                    'role_id'           => 1,
                    'password'          => Hash::make('qwerty')
                ]);

                factory(User::class, 10)->create();
            }
        }
    }
}
