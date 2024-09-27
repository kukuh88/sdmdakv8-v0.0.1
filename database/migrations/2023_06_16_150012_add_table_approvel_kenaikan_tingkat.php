<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableApprovelKenaikanTingkat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvel_kenaikan', function (Blueprint $table) {
            $table->id()->comment('karyawan siapa saja yang masuk di hold');
            $table->unsignedBigInteger('id_karyawan');
            $table->string('golonganini');
            $table->string('golongannaik');
            $table->tinyInteger('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('approvel_kenaikan');
    }
}
