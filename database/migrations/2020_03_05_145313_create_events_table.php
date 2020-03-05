<?php

use App\Entity\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    private $eventsTableName;

    public function __construct()
    {
        $this->eventsTableName = Event::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->eventsTableName)) {
            Schema::create($this->eventsTableName, function (Blueprint $table) {
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
        Schema::dropIfExists($this->eventsTableName);
    }
}
