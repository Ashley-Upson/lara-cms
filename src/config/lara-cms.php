<?php

return [
    /**
     * LaraCMS uses these two config options to determine where your users are stored.
     * You may also choose to have LaraCMS handle authentication for you.
     */
    'users_connection' => 'mysql',
    'users_table' => 'users',

    /**
     * LaraCMS can be configured to use it's own authentication so you don't have to.
     * The below config fields should be set to your own routes if you use your own authentication.
     * The login and register routes are ignored if use_cms_authentication is true.
     * When use_cms_authentication is false, the login and register routes will be used as URLs.
     */
    'use_cms_authentication' => true,
    'login_route' => null,
    'register_route' => null,

    /**
     * LaraCMS will host the CMS admin panel at the following URL.
     */
    'admin_panel_route' => '/cms/admin/',

    /**
     * This will be appended to all CMS page routes that are not part of the admin panel.
     */
    'page_prefix' => '/page/',

    /**
     * This is the connection that the CMS will use to store its data.
     * The prefix can be used if you'd like an easier way to differentiate your apps tables from the CMS, such as if you only have/want one database.
     *
     * todo: Add a cms_users_table_prefix field to extend the customisability of the CMS.
     * todo: Write helpers to get fields that can be customised by the config files.
     * todo: Replace usages of customisable fields with the helper functions.
     * todo: Update user relationships to use the config file.
     */
    'cms_connection' => 'mysql',
    'cms_table_prefix' => '',

    /**
     * The following functions are removed by default from blade contents.
     * These functions can reveal protected information about the application, such as database passwords.
     * It is recommended to only add to this list; removing entries may expose data.
     * Example usage: {{ env('DB_PASSWORD') }}
     */
    'blade_banned_functions' => [
        'env',
        'app',
        'config',
    ]
];