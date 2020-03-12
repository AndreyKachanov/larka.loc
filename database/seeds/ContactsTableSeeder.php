<?php

use App\Entity\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (Contact::count() != 0) {
            throw new Exception(Contact::getTableName() . ' table is not empty. Truncate all tables!');
        }

        for ($i = 1; $i <= 10; $i++) {
            Contact::create(['name' => 'Contact' . $i]);
        }
    }
}
