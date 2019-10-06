<?php
/*
 * Plugin Name: Рекламные интеграции
 * Description: Плагин для работы с рекламными интеграциями
 * Author:      SVteam
 * Version:     1.0
 */

require_once plugin_dir_path(__FILE__) . 'includes/models/Advert.php';

add_action('admin_menu', 'createLinkOnMainMenuAdvert');


function createDatabaseAdvert()
{
    global $table_prefix, $wpdb;

    $tblname = 'advert_integration';
    $wp_track_table = $table_prefix . "$tblname ";

    if($wpdb->get_var( "show tables like $wp_track_table" ) != $wp_track_table) 
    {
        $sql = "CREATE TABLE $wp_track_table (
          id int(11) NOT NULL,
          article_id int(11) DEFAULT NULL,
          text text COLLATE utf8_unicode_ci,
          name varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
          end_date int(11) DEFAULT NULL,
          is_active tinyint(1) DEFAULT '1',
          UNIQUE KEY id (id)
        );";

        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }
}

register_activation_hook( __FILE__, 'createDatabaseAdvert' );

function createLinkOnMainMenuAdvert()
{
    add_menu_page(
        'Рекламные интеграции',
        'Рекламные интеграции',
        'manage_options',
        'advert-integration/includes/main.php',
        null,
        'dashicons-migrate'
    );
}