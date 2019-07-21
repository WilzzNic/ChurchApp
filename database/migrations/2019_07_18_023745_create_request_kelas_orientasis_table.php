<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestKelasOrientasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_kelas_orientasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jemaat_id');
            $table->integer('jadwal_kom_id');
            $table->string('asal_gereja');
            $table->date('tanggal');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_kelas_orientasis');
    }
}
