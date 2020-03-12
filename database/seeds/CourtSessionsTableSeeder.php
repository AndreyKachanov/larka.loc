<?php

use App\Entity\CourtSession;
use Illuminate\Database\Seeder;

class CourtSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (CourtSession::count() != 0) {
            throw new Exception(CourtSession::getTableName() . ' table is not empty. Truncate all tables!');
        }

        factory(CourtSession::class, 10)->create();
    }
}
