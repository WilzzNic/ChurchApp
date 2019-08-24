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
            $table->integer('family_altar_id')->nullable();
            $table->string('seri_kaj_1')->nullable();
            $table->string('seri_kaj_2')->nullable();
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

            // Combination of 2 columns to create a uniqiue value
            $table->unique(['seri_kaj_1', 'seri_kaj_2']);
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
