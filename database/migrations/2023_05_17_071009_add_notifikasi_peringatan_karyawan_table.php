<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotifikasiPeringatanKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->date('notifikasi_peringatan_pada')->comment('diset ketika create karyawan');
            $table->dateTime('notifikasi_peringatan_dikirim_pada')->nullable()->comment('diset ketika mengirim notifikasi sesuai tanggalnya');
            $table->dateTime('notifikasi_peringatan_dibaca_pada')->nullable()->comment('diset ketika notifikasi sudah dibaca');
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
            $table->dropColumn('notifikasi_peringatan_pada');
            $table->dropColumn('notifikasi_peringatan_dikirim_pada');
            $table->dropColumn('notifikasi_peringatan_dibaca_pada');
        });
    }
}
