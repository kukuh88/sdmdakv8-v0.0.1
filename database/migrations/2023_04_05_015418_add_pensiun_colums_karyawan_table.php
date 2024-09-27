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
        Schema::table('karyawan', function (Blueprint $table) {
            $table->tinyInteger('pilihan_pensiun')->nullable()->comment('12/6');

            $table->dateTime('notifikasi_pensiun_1_at')->nullable()->comment('ketika job cek 56 th sudah berjalan & karyawannya masuk >56');
            $table->dateTime('notifikasi_pensiun_1_readed')->nullable();
            
            $table->dateTime('notifikasi_pensiun_2_at')->nullable();
            $table->dateTime('notifikasi_pensiun_2_readed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('pilihan_pensiun');

            $table->dropColumn('notifikasi_pensiun_1_at');
            $table->dropColumn('notifikasi_pensiun_1_readed');
            
            $table->dropColumn('notifikasi_pensiun_2_at');
            $table->dropColumn('notifikasi_pensiun_2_readed');
        });
    }
};