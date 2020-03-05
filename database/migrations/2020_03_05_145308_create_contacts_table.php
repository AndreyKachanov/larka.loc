<?php

use App\Entity\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    private $contactsTableName;

    public function __construct()
    {
        $this->contactsTableName = Contact::getTableName();
    }

    /**
     * Run the migrations.
     *ё
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->contactsTableName)) {
            Schema::create($this->contactsTableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->nullable();
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->contactsTableName);
    }
}
