<?php

use App\Entity\User\Permission;
use App\Entity\User\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entity\User\PermissionRoles;

class CreatePermissionRolesTable extends Migration
{
    private $permissionRolesTableName;
    private $permissionsTableName;
    private $rolesTableName;

    public function __construct()
    {
        $this->permissionRolesTableName = PermissionRoles::getTableName();
        $this->permissionsTableName = Permission::getTableName();
        $this->rolesTableName = Role::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->permissionRolesTableName)) {
            Schema::create($this->permissionRolesTableName, function (Blueprint $table) {
                //составной первичный ключ, чтобы не дублировались записи
                $table->primary(['permission_id','role_id']);
                $table->unsignedSmallInteger('permission_id');
                $table->unsignedSmallInteger('role_id');
                $table->string('test')->nullable();
                $table->timestamps();

                //создаем  индекс для role_id
                $table->index(['permission_id'], 'idx_permission_id');
                //создаем  индекс для user_id
                $table->index(['role_id'], 'idx_role_id');

                //создаем внешний ключ для permission_id поля
                $table->foreign('permission_id', 'fk_permission_id')
                    ->references('id')
                    ->on($this->permissionsTableName)
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                //создаем внешний ключ для role_id поля
                $table->foreign('role_id', 'fk_role_id')
                    ->references('id')
                    ->on($this->rolesTableName)
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists($this->permissionRolesTableName);
    }
}
