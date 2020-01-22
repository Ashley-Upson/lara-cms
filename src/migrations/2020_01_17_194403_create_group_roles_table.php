<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_id')->index()->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->bigInteger('role_id')->index()->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::dropIfExists('group_roles');
    }
}
