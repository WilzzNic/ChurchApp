<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyAltarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_altars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('daerah_id');
            $table->string('FA_number');
            $table->text('alamat');
            $table->string('hari', 10);
            $table->time('waktu');
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
        Schema::dropIfExists('family_altars');
    }
}
