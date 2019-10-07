<?php

class Advert
{
    private $post = null;

    public static $table = 'wp_advert_integration';

    function __construct(int $post_id) {
        $this->post = get_post($post_id);
    }

    public static function getAll(string $param = null, $page = 1)
    {
        global $wpdb;

        $limit = 50;
        $offset = $limit * ($page-1);

        return $wpdb->get_results("SELECT wp_advert_integration.*, wp_posts.post_name as url FROM `wp_advert_integration` INNER JOIN wp_posts ON article_id = wp_posts.id ORDER BY wp_advert_integration.id DESC LIMIT " . $limit . " OFFSET " . $offset);
    }

    public static function getCount(string $query = null)
    {
        global $wpdb;
        return $wpdb->get_results('SELECT count(*) as count FROM ' . self::$table . ' ' . $query);
    }
}