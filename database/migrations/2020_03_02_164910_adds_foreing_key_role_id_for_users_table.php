<?php

use App\Entity\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddsForeingKeyRoleIdForUsersTable extends Migration
{
    private $usersTableName;

    public function __construct()
    {
        $this->usersTableName = User::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->usersTableName, function (Blueprint $table) {
            //создаем  индекс для role_id
            $table->index(['role_id'], 'idx_role_id');

            //создаем внешний ключ для role_id поля
            $table->foreign(['role_id'], 'fk_role')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->usersTableName, function (Blueprint $table) {
            if (Schema::hasColumn($this->usersTableName, 'role_id')) {
                $table->dropForeign('fk_role');
                $table->dropIndex('idx_role_id');
            }
        });
    }
}
