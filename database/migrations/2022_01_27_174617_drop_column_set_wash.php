<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnSetWash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('set_wash', function($table) {
            $table->dropColumn('id');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */


    public function down()
    {
        Schema::table('set_wash', function($table) {
            $table->integer('id');

        });
    }

}
