<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content_id')->index()->unsigned();
            $table->foreign('content_id')->references('id')->on('content')->onDelete('cascade');
            $table->integer('order')->default(1);
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('label');
            $table->string('placeholder')->nullable();
            $table->boolean('is_disabled')->default(0);
            $table->boolean('is_required')->default(0);
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
        Schema::dropIfExists('form_components');
    }
}