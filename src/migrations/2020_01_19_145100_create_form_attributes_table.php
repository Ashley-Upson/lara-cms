<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_id')->index()->unsigned()->nullable();
            $table->foreign('content_id')->references('id')->on('content')->onDelete('cascade');
            $table->bigInteger('component_id')->index()->unsigned()->nullable();
            $table->foreign('component_id')->references('id')->on('form_components')->onDelete('cascade');
            $table->bigInteger('option_id')->index()->unsigned()->nullable();
            $table->foreign('option_id')->references('id')->on('form_options')->onDelete('cascade');
            $table->string('attribute');
            $table->string('value')->nullable();
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
        Schema::dropIfExists('form_attributes');
    }
}
