<?php

return [
    /**
     * LaraCMS uses these two config options to determine where your users are stored.
     */
    'users_connection' => 'mysql',
    'users_table' => 'users',

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
     * @todo: Add a cms_users_table_prefix field to extend the customisability of the CMS.
     * @todo: Write helpers to get fields that can be customised by the config files.
     * @todo: Replace usages of customisable fields with the helper functions.
     * @todo: Update user relationships to use the config file.
     */
    'cms_connection' => 'mysql',
    'cms_table_prefix' => '',
];