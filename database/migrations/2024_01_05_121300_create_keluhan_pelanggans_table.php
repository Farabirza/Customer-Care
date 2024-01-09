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
        Schema::create('keluhan_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('email', 100);
            $table->string('nomor_hp', 15);
            $table->string('status_keluhan', 1)->default(0);
            $table->string('keluhan', 255);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('keluhan_pelanggans');
    }
};
