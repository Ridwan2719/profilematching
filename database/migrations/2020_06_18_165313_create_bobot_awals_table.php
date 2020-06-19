<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobotAwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobot_awals', function (Blueprint $table) {
            $table->id();
            $table->string('gap_a');
            $table->string('gap_b');
            $table->string('keterangan');
            $table->string('nilai');
            $table->string('jenisbobot_id');
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
        Schema::dropIfExists('bobot_awals');
    }
}
