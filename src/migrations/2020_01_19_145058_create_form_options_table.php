<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('component_id')->index()->unsigned()->nullable();
            $table->foreign('component_id')->references('id')->on('form_components')->onDelete('cascade');
            $table->integer('order')->default(1);
            $table->string('label');
            $table->string('value')->nullable();
            $table->boolean('is_disabled')->default(0);
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
        Schema::dropIfExists('form_options');
    }
}
