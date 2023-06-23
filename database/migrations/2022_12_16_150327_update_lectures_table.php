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
        Schema::table('lectures', function (Blueprint $table){

            $table->foreignId('meeting_id')->change()->references('id')->on('meetings')
                ->onDelete('cascade');
            $table->foreignId('user_id')->change()->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('zoom_id',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign('lectures_meeting_id_foreign');
            $table->dropForeign('lectures_user_id_foreign');

            $table->dropColumn('zoom_id');
        });
    }
};
