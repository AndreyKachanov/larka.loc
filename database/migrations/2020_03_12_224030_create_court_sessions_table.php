<?php

use App\Entity\CourtSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourtSessionsTable extends Migration
{
    private $courtSessionsTableName;

    public function __construct()
    {
        $this->courtSessionsTableName = CourtSession::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->courtSessionsTableName)) {
            Schema::create('court_sessions', function (Blueprint $table) {
                $table->primary(['date','number']);

                $table->dateTime('date')->nullable();
                $table->string('number', 25)->nullable();
                $table->json('judges')->nullable();
                $table->text('involved')->nullable();
                $table->text('description')->nullable();
                $table->unsignedTinyInteger('room')->nullable();
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
        Schema::dropIfExists('court_sessions');
    }
}
