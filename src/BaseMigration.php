<?php

namespace LaraCMS;

use Illuminate\Database\Migrations\Migration;

/**
 * Class BaseMigration
 * @package LaraCMS
 *
 * @property string cmsConnection
 * @property string cmsTablePrefix
 * @property string usersConnection
 * @property string usersTable
 *
 * todo: Write tests to check successful table builds with various configs in a clean laravel project.
 */
class BaseMigration extends Migration
{
    public $cmsConnection;
    public $cmsTablePrefix;
    public $usersConnection;
    public $usersTable;

    public function __construct()
    {
        $this->cmsConnection = \Config::get('lara-cms.cms_connection');
        $this->cmsTablePrefix = \Config::get('lara-cms.cms_table_prefix');
        $this->usersConnection = \Config::get('lara-cms.users_connection');
        $this->usersTable = \Config::get('lara-cms.users_table');
    }
}