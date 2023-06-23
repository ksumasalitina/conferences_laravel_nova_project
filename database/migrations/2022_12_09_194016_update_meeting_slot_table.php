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
        Schema::table('meeting_slot', function (Blueprint $table){
            $table->dropForeign('meeting_slot_meeting_id_foreign');
            $table->dropForeign('meeting_slot_slot_id_foreign');

            $table->foreignId('meeting_id')->change()->references('id')->on('meetings')
                ->onDelete('cascade');
            $table->foreignId('slot_id')->change()->references('id')->on('slots')
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
        Schema::table('meeting_slot', function (Blueprint $table){
            $table->dropForeign('meeting_slot_meeting_id_foreign');
            $table->dropForeign('meeting_slot_slot_id_foreign');

            $table->foreignId('meeting_id')->change()->constrained();
            $table->foreignId('slot_id')->change()->constrained();
        });
    }
};
