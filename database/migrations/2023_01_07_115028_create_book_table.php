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
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_karyawan');
            // $table->string('name');
            // $table->string('jabatan');
            $table->string('golonganini');
            $table->date('tmt_golonganini');
            $table->string('golongan');
            $table->date('tmt_golongan');
            $table->string('eselon');
            $table->string('status');
            $table->date('tmt_eselon');
            $table->tinyInteger('is_pilihan')->default(0);
            $table->tinyInteger('hold')->default(0);
            $table->unsignedBigInteger('last_approval_id')->nullable();
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
        Schema::dropIfExists('book');
    }
};
