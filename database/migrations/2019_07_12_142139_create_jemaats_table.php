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
            $table->integer('k_a_j_id');
            $table->integer('k_o_m_id');
            $table->integer('baptis_id');
            $table->integer('familyaltar_id');
            $table->integer('no_kaj')->unique();
            $table->string('nama');
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('profesi');
            $table->string('status_pernikahan');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('lokasi_ibadah');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->string('status');
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
        Schema::dropIfExists('jemaats');
    }
}
