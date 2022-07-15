<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryObj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_auto', function (Blueprint $table) {
        $table->id();
        $table->integer('obj_id');
        $table->integer('number_cat')->default('null');
        $table->string('name_cat');
        $table->string('descriptions_cat')->default('null');
        $table->integer('cost_more');
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
