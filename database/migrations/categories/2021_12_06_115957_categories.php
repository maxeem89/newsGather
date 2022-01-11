<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories',function ( Blueprint $table)
        {
            $table->id();
            $table->string('name')->unique();
            $table->text('sub_link');
            $table->bigInteger('resources_id');
            $table->foreign('resources_id')
                ->references('id')->on('resources')
                ->onDelete('cascade');
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

    }
}
