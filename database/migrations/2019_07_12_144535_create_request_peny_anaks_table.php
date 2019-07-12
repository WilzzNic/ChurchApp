<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestPenyAnaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_peny_anaks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jemaat_id');
            $table->integer('cabang_gereja_id');
            $table->string('nama_anak');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->date('tgl_penyerahan');
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
        Schema::dropIfExists('request_peny_anaks');
    }
}
