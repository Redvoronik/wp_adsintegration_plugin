<?php
class Advert
{
    private $id = null;
    private $post_id = null;
    private $contact = null;
    private $content = null;
    private $end_date = null;
    private $is_active = 0;
    public static $table = 'advert_integration';
    function __construct(array $input) {
        $this->id = (isset($input['id'])) ?? null;
        $this->post_id = $input['post_id'];
        $this->contact = $input['contact'];
        $this->content = $input['content'];
        $this->end_date = $input['end_date'];
        $this->is_active = (isset($input['is_active']) && $input['is_active']) ? 1 : 0;
    }
    public function save()
    {
        global $wpdb, $table_prefix;

        $sql = "INSERT INTO {$table_prefix}" . self::$table . " (`post_id`, `contact`, `content`, `end_date`, `is_active`) VALUES ( " . $this->post_id . ", '" . $this->contact . "', '" . $this->content . "', '" . $this->end_date . "', " . $this->is_active . ")";
        return $wpdb->get_results($sql);
    }
    public function update()
    {
        global $wpdb, $table_prefix;
        $sql = "UPDATE {$table_prefix}" . self::$table . " SET 
        `post_id` = \"" . $this->post_id . "\", 
        `contact` = \"" . $this->contact . "\",
        `content` = \"" . $this->content . "\", 
        `end_date` = \"" . $this->end_date . "\", 
        `is_active` = \"" . $this->is_active . "\" WHERE id = " . $this->id;
        return $wpdb->get_results($sql);
    }
    public function delete()
    {
        global $wpdb, $table_prefix;
        $sql = "DELETE FROM {$table_prefix}" . self::$table . " WHERE id = " . $this->id;
        return $wpdb->get_results($sql);
    }
    public static function getAll($page = 1, $orderBy = 'id', $order = 'DESC')
    {
        global $wpdb, $table_prefix;
        $limit = 50;
        $offset = $limit * ($page-1);
        return $wpdb->get_results("SELECT " . self::$table . ".*, {$table_prefix}posts.post_name as url, {$table_prefix}posts.post_title as post_title FROM {$table_prefix}" . self::$table . " as " . self::$table . " INNER JOIN {$table_prefix}posts ON post_id = {$table_prefix}posts.id ORDER BY " . self::$table . "." . $orderBy . " " . $order . " LIMIT " . $limit . " OFFSET " . $offset);
    }
    public static function getCount(string $query = null)
    {
        global $wpdb;
        return $wpdb->get_results("SELECT count(*) as count FROM {$table_prefix}" . self::$table . " " . $query);
    }
    public static function find(int $id, $is_active = false)
    {
        global $wpdb;
        $where = ($is_active) ? " AND is_active = '$is_active' AND end_date > NOW()" : null;
        $res = $wpdb->get_results("SELECT * FROM {$table_prefix}" . self::$table . " WHERE id = '$id' " . $where ." LIMIT 1",ARRAY_A);
        $advert = (isset($res[0])) ? new Advert($res[0]) : null;
        return $advert;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getPost()
    {
        return get_post($this->post_id);
    }
    public function getPostId()
    {
        return $this->post_id;
    }
    public function getContact()
    {
        return $this->contact;
    }
    public function getEnddate()
    {
        return $this->end_date;
    }
    public function getActive()
    {
        return $this->is_active;
    }
    public function getId()
    {
        return $this->id;
    }
}