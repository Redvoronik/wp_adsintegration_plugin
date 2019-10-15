<?php
/*
 * Plugin Name: Рекламные интеграции
 * Description: Плагин для работы с рекламными интеграциями
 * Author:      SVteam
 * Version:     1.0
 */

require_once plugin_dir_path(__FILE__) . 'includes/models/Advert.php';

add_action('admin_menu', 'createLinkOnMainMenuAdvert');
// add_action('admin_init','loadVendor');
add_shortcode('article_advertising_place', 'renderIntegration');

function createDatabaseAdvert()
{
    global $table_prefix, $wpdb;

    $tblname = 'advert_integration';
    $wp_track_table = $table_prefix . "$tblname ";

    if($wpdb->get_var( "show tables like $wp_track_table" ) != $wp_track_table) 
    {
        $sql = "CREATE TABLE $wp_track_table (
          `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
          `post_id` bigint(20) UNSIGNED DEFAULT NULL,
          `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
          `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
          `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `is_active` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`),
          KEY `post_id` (`post_id`)
        );";

        $wpdb->get_results($sql);

        $set_link = "ALTER TABLE $wp_track_table ADD CONSTRAINT `posts` FOREIGN KEY (`post_id`) REFERENCES `wp_posts`(`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT";

        $wpdb->get_results($set_link);
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

    add_submenu_page(
        'advert-integration/includes/main.php',
        'Добавить новую',
        'Добавить новую',
        'manage_options',
        'advert-integration/includes/create.php'
    );

    add_submenu_page(
        null,
        'Редактировать',
        'Редактировать интеграцию',
        'manage_options',
        'advert-integration/includes/edit.php'
    );

    add_submenu_page(
        null,
        'Удалить',
        'Удалить интеграцию',
        'manage_options',
        'advert-integration/includes/delete.php'
    );
}

function renderIntegration($atts)
{
   $advert = Advert::find($atts['id'], true);
   return ($advert) ? $advert->getContent() : null;
}

function advert_save_success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Done!', 'sample-text-domain' ); ?></p>
    </div>
    <?php
}


// function loadVendor() {
//     wp_register_style('select2', plugins_url('includes/vendor/select2/css/select2.min.css',__FILE__ ));
//     wp_enqueue_style('select2');
//     wp_register_script('jquery3', plugins_url('includes/vendor/jquery/jquery-3.4.1.min.js',__FILE__),array('jquery'), '3.4.1', true);
//     wp_enqueue_script('jquery3');
//     wp_register_script('select2', plugins_url('includes/vendor/select2/js/select2.full.min.js',__FILE__ ));
//     wp_enqueue_script('select2');
// }