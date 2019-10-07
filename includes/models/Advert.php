<?php

class Advert
{
    private $post = null;
    private $article_id = null;
    private $name = null;
    private $text = null;
    private $end_date = null;
    private $is_active = null;

    public static $table = 'wp_advert_integration';

    function __construct(array $input) {
        $this->article_id = $input['article_id'];
        $this->name = $input['name'];
        $this->text = $input['text'];
        $this->end_date = $input['end_date'];
        $this->is_active = $input['is_active'] ? 1 : 0;
        $this->post = get_post($input['article_id']);
    }

    public function save()
    {
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

        $sql = "INSERT INTO " . self::$table . " (`article_id`, `name`, `text`, `end_date`, `is_active`) VALUES ( " . $this->article_id . ", '" . $this->name . "', '" . $this->text . "', '" . $this->end_date . "', " . $this->is_active . ")";

        dbDelta($sql);
    }

    public static function getAll(string $param = null, $page = 1)
    {
        global $wpdb;

        $limit = 50;
        $offset = $limit * ($page-1);

        return $wpdb->get_results("SELECT wp_advert_integration.*, wp_posts.post_name as url FROM " . self::$table . " as wp_advert_integration INNER JOIN wp_posts ON article_id = wp_posts.id ORDER BY wp_advert_integration.id DESC LIMIT " . $limit . " OFFSET " . $offset);
    }

    public static function getCount(string $query = null)
    {
        global $wpdb;
        return $wpdb->get_results('SELECT count(*) as count FROM ' . self::$table . ' ' . $query);
    }

    public static function find(int $id, $is_active = false)
    {
        global $wpdb;

        $where = ($is_active) ? " AND is_active = '$is_active' AND end_date > NOW()" : null;

        $res = $wpdb->get_results("SELECT * FROM " . self::$table . " WHERE id = '$id' " . $where ." LIMIT 1",ARRAY_A);

        return new Advert($res[0]);
    }

    public function getText()
    {
        return $this->text;
    }
}