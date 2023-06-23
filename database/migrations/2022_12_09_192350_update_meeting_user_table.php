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
        Schema::table('meeting_user', function (Blueprint $table){
            $table->dropForeign('meeting_user_meeting_id_foreign');
            $table->dropForeign('meeting_user_user_id_foreign');

            $table->foreignId('meeting_id')->change()->references('id')->on('meetings')
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
        Schema::table('meeting_user', function (Blueprint $table){
            $table->dropForeign('meeting_user_meeting_id_foreign');
            $table->dropForeign('meeting_user_user_id_foreign');

            $table->foreignId('meeting_id')->change()->constrained();
            $table->foreignId('user_id')->change()->constrained();
        });
    }
};
