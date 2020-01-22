<?php

use AshleyUpson\LaraCMS\BaseMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddUserFields extends BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->usersConnection)->table($this->usersTable, function (Blueprint $table) {
            $table->boolean('is_admin')->default(0);
            $table->boolean('force_reset')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->timestamp('banned_at')->nullable();
            $table->timestamp('banned_until')->nullable();
            $table->string('banned_reason')->nullable();
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
        Schema::connection($this->usersConnection)->table($this->usersTable, function (Blueprint $table) {
            $table->dropColumn([
                'is_admin',
                'force_reset',
                'is_banned',
                'banned_at',
                'banned_until'
            ]);

            $table->dropSoftDeletes();
        });
    }
}
