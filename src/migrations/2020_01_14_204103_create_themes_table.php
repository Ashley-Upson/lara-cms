<?php

use LaraCMS\BaseMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateThemesTable extends BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->cmsConnection)->create('themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('view')->nullable();
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
        Schema::connection($this->cmsConnection)->dropIfExists('theme');
    }
}
