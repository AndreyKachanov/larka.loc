<?php

use App\Entity\Post;
use App\Entity\User\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (Post::count() != 0) {
            throw new Exception(User::getTableName() . ' table is not empty. Truncate all tables!');
        }

        User::all()->each(function (User $user) {
            factory(Post::class, 3)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
