<?php

use App\Entity\Star;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarsTable extends Migration
{
    private $starsTableName;

    public function __construct()
    {
        $this->starsTableName = Star::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->starsTableName)) {
            Schema::create($this->starsTableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedSmallInteger('starrable_id')->nullable();
                $table->string('starrable_type')->nullable();
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
        Schema::dropIfExists($this->starsTableName);
    }
}
