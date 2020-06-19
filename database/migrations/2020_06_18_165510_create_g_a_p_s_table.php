<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGAPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_a_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('altet_id');
            $table->string('kriteria_id');
            $table->string('subkriteria_id');
            $table->string('nilai');
            $table->string('periode_id');
            $table->string('penilaian_id');
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
        Schema::dropIfExists('g_a_p_s');
    }
}
