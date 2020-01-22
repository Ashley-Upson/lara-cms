<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_id')->index()->unsigned();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->bigInteger('group_id')->index()->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::dropIfExists('page_groups');
    }
}
