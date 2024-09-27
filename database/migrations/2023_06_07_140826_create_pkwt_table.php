<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkwtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkwt', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('formFileSm')->nullable();
            $table->string('full_name');
            $table->string('jabatan');
            $table->string('tgl_bergabung');
            $table->string('tgl_berakhir');
            $table->date('notifikasi_pkwt_at')->nullable();
            $table->date('notifikasi_pkwt_readed')->nullable();
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
        Schema::dropIfExists('pkwt');
    }
}
