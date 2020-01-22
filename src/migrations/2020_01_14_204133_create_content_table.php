<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('page_id')->unsigned()->index();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->string('title');
            $table->string('type');
            $table->longText('content')->nullable();
            $table->boolean('is_html')->default(0);
            $table->boolean('is_hidden')->default(0);
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('content');
    }
}
