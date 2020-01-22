<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishedFieldToNavigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigation', function (Blueprint $table) {
            $table->boolean('is_published')->default(1);
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
            $table->dropColumn(['is_published']);
        });
    }
}
