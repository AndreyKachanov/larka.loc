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
     * @throws Exception
     */
    public function run()
    {
        if (User::count() != 0) {
            throw new Exception('Users table is not empty. Stop all seeds!!!');
        }

        User::create([
            'email'             => 'test@test.loc',
            'name'              => 'Иван Иванов',
            'phone'             => '380997111111',
            'phone_auth'        => false,
            'phone_verified'    => false,
            'email_verified_at' => Carbon::now(),
            'role_id'           => 1, // Admin
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
            'status'            => User::STATUS_ACTIVE,
            'password'          => Hash::make('qwerty')
        ]);

        factory(User::class, 2)->create();
    }
}
