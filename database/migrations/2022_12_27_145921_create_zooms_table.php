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
        Schema::create('zooms', function (Blueprint $table) {
            $table->id();
            $table->string("uuid",50);
            $table->string("host_id",50);
            $table->string( "topic",100);
            $table->integer( "type");
            $table->string("start_time",50);
            $table->integer("duration");
            $table->string("timezone",100);
            $table->string("join_url",100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zooms');
    }
};
