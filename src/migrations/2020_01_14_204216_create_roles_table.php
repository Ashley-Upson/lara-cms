<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('admin')->default(0);
            $table->boolean('create_page')->default(0);
            $table->boolean('edit_page')->default(0);
            $table->boolean('delete_page')->default(0);
            $table->boolean('create_content')->default(0);
            $table->boolean('edit_content')->default(0);
            $table->boolean('delete_content')->default(0);
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
        Schema::dropIfExists('roles');
    }
}
