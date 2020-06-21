<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormaisasiBobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normaisasi_bobots', function (Blueprint $table) {
            $table->id();
            $table->string('penilaian_id');
            $table->string('atlet_id');
            $table->string('periode_id');
            $table->string('kriteria_id');
            $table->string('bobot_id');
            $table->double('nilai');
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
        Schema::dropIfExists('normaisasi_bobots');
    }
}
