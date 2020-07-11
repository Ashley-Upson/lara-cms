<?php

use LaraCMS\BaseMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->cmsConnection)->create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('theme_id')->index()->unsigned()->nullable();
            $table->foreign('theme_id')->references('id')->on('themes');
            $table->string('name');
            $table->string('title');
            $table->boolean('is_published')->default(1);
            $table->string('custom_route')->nullable();
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
        Schema::connection($this->cmsConnection)->dropIfExists('pages');
    }
}
