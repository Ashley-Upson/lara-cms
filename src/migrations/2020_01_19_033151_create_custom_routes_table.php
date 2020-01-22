<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_id')->index()->unsigned()->nullable();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->string('request_method')->default('get');
            $table->string('custom_route');
            $table->string('custom_handler')->nullable();
            $table->boolean('is_published')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_routes');
    }
}
