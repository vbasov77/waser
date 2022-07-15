<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoreObj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('more_obj', function (Blueprint $table) {
            $table->id();
            $table->integer('obj_id');
            $table->integer('number_more')->default(null);
            $table->string('name_more');
            $table->string('descriptions_more')->default(null);
            $table->integer('cost_more');
            $table->string('time_more');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
