<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table){

            $table->foreignId('lecture_id')->change()->references('id')->on('lectures')
                ->onDelete('cascade');
            $table->foreignId('user_id')->change()->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_lecture_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
        });
    }
};
