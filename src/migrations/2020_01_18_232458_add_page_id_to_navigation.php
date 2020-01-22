<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageIdToNavigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigation', function (Blueprint $table) {
            $table->bigInteger('page_id')->unsigned()->index()->nullable();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navigation', function (Blueprint $table) {
            $table->dropColumn(['page_id']);
        });
    }
}
