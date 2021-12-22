<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained();
            $table->string('nip', 50);
            $table->string('nama', 100);
            $table->string('tempat_lahir');
            $table->dateTime('tanggal_lahir');
            $table->string('agama', 50);
            $table->string('jenis_kelamin', 50);
            $table->text('alamat');
            $table->string('nomor', 50);
            $table->string('email', 50);

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
        Schema::dropIfExists('dosens');
    }
}
