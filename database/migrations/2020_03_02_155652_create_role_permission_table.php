<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionTable extends Migration
{
    private $tableName = 'role_permission';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            //составной первичный ключ, чтобы не дублировались записи
            $table->primary(['permission_id','role_id']);
            $table->unsignedSmallInteger('permission_id');
            $table->unsignedSmallInteger('role_id');
            $table->timestamps();

            //создаем  индекс для role_id
            $table->index(['permission_id'], 'idx_permission_id');
            //создаем  индекс для user_id
            $table->index(['role_id'], 'idx_role_id');

            //создаем внешний ключ для permission_id поля
            $table->foreign('permission_id', 'fk_permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //создаем внешний ключ для role_id поля
            $table->foreign('role_id', 'fk_role_id')
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
        Schema::dropIfExists($this->tableName);
    }
}
