<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoresecondariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coresecondaries', function (Blueprint $table) {
            $table->id();
            $table->string("penilaian_id");
            $table->string("periode_id");
            $table->string("atlet_id");
            $table->string("jenisbobot_id");
            $table->double("hasil");
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
        Schema::dropIfExists('coresecondaries');
    }
}
