<?php

class Advert
{
    private $post_id = null;
    private $contact = null;
    private $content = null;
    private $end_date = null;
    private $is_active = null;

    public static $table = 'wp_advert_integration';

    function __construct(array $input) {
        $this->post_id = $input['post_id'];
        $this->contact = $input['contact'];
        $this->content = $input['content'];
        $this->end_date = $input['end_date'];
        $this->is_active = $input['is_active'] ? 1 : 0;
    }

    public function save()
    {
        global $wpdb;

        $sql = "INSERT INTO " . self::$table . " (`post_id`, `contact`, `content`, `end_date`, `is_active`) VALUES ( " . $this->post_id . ", '" . $this->contact . "', '" . $this->content . "', '" . $this->end_date . "', " . $this->is_active . ")";

        return $wpdb->get_results($sql);
    }

    public static function getAll(string $param = null, $page = 1)
    {
        global $wpdb;

        $limit = 50;
        $offset = $limit * ($page-1);

        return $wpdb->get_results("SELECT wp_advert_integration.*, wp_posts.post_name as url FROM " . self::$table . " as wp_advert_integration INNER JOIN wp_posts ON post_id = wp_posts.id ORDER BY wp_advert_integration.id DESC LIMIT " . $limit . " OFFSET " . $offset);
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

    public function getContent()
    {
        return $this->content;
    }
}