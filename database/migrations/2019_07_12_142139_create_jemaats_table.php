<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJemaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            // Untuk mengetahui jemaat berada di family altar mana
            $table->integer('family_altar_id')->nullable();

            // Nomor Induk Jemaat
            $table->integer('seri_keluarga')->unsigned()->nullable();
            $table->integer('seri_jemaat')->unsigned()->nullable();

            $table->string('nama');
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir');
            $table->string('profesi')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('lokasi_ibadah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->unique(['seri_keluarga', 'seri_jemaat']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemaats');
    }
}
