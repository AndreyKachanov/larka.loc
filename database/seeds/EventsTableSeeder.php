<?php

use App\Entity\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (Event::count() != 0) {
            throw new Exception(Event::getTableName() . ' table is not empty. Truncate all tables!');
        }

        $i = 0;
        while ($i++<10) {
            Event::create(['name' => 'Event' . $i]);
        }
    }
}
