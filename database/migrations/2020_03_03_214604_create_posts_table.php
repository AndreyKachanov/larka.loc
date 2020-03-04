<?php

use App\Entity\Post;
use App\Entity\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    private $postsTableName;

    public function __construct()
    {
        $this->postsTableName = Post::getTableName();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->postsTableName)) {
            Schema::create($this->postsTableName, function (Blueprint $table) {
                $table->smallIncrements('id');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->unsignedSmallInteger('user_id')->nullable();
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
        Schema::dropIfExists($this->postsTableName);
    }
}
