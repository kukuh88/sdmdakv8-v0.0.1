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
        Schema::table('book', function (Blueprint $table) {
            $table->dateTime('notifikasi_tmtgolongan_at')->nullable()->comment('ketika sudah mencapai tmtnya');
            $table->dateTime('notifikasi_tmtgolongan_readed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book', function (Blueprint $table) {
            $table->dropColumn('notifikasi_tmtgolongan_at');
            $table->dropColumn('notifikasi_tmtgolongan_readed');
        });
    }
};