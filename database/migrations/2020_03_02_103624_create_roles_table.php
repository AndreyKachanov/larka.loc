<?php

use App\Entity\User\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    private $rolesTableName;

    public function __construct()
    {
        $this->rolesTableName = Role::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->rolesTableName)) {
            Schema::create($this->rolesTableName, function (Blueprint $table) {
                $table->smallIncrements('id');
                $table->string('name');
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
        Schema::dropIfExists($this->rolesTableName);
    }
}
