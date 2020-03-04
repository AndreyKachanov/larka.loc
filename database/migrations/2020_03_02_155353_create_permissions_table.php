<?php

use App\Entity\User\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{

    private $permissionsTableName;

    public function __construct()
    {
        $this->permissionsTableName = Permission::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->permissionsTableName)) {
            Schema::create($this->permissionsTableName, function (Blueprint $table) {
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
        Schema::dropIfExists($this->permissionsTableName);
    }
}
