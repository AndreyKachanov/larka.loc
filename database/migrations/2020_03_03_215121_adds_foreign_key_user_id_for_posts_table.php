<?php

use App\Entity\Post;
use App\Entity\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddsForeignKeyUserIdForPostsTable extends Migration
{

    private $usersTableName;
    private $postsTableName;

    public function __construct()
    {
        $this->postsTableName = Post::getTableName();
        $this->usersTableName = User::getTableName();
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->postsTableName, function (Blueprint $table) {
            $table->index('user_id', 'idx_user_id');

            //создаем внешний ключ для role_id поля
            $table->foreign(['user_id'], 'fk_user')
                ->references('id')
                ->on($this->usersTableName)
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
        Schema::table($this->postsTableName, function (Blueprint $table) {
            if (Schema::hasColumn($this->postsTableName, 'user_id')) {
                $table->dropForeign('fk_user');
                $table->dropIndex('idx_user_id');
            }
        });
    }
}
