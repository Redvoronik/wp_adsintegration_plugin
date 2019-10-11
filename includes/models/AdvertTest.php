<?php
require_once 'Advert.php';

use PHPUnit\Framework\WP_UnitTestCase;

class AdvertTest extends WP_UnitTestCase
{

//     function setUp() {
//     parent::setUp();
//     // include_once( path for gfdl_versioning function);
//     GFDataLayer::init_globals();
//     gfdl_versioning(); /* this creates the tables */

//      add test users (to give them a role add a 'role' parameter to this add user) 
//     $this->users[0] = wp_insert_user(array('user_login' => 'test1'));
//     $this->users[1] = wp_insert_user(array('user_login' => 'test2'));
// }

// function tearDown() {
//     global $wpdb;
//     /* these lines don't work for some reason */
//     $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gfdl_bullets;');
//     $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gfdl_character_ai;');
//     $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gfdl_items;');
//     $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gfdl_sprites;');
//     $wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'gfdl_backgrounds;');

//     wp_delete_user($this->users[0]);
//     wp_delete_user($this->users[1]);
//     parent::tearDown();
// }

    public function testCreate()
    {
        $advert = $this->initAdvert();

        $this->assertTrue(!empty($advert));
    }

    public function testSave()
    {
        global $wpdb;
        $advert = $this->initAdvert();

        $this->assertTrue($advert->save());
    }

    public function testGetContent()
    {
        $advert = $this->initAdvert();

        $content = $advert->getContent();

        $this->assertTrue(($content == 'content') ? true : false);
    }

    private function initAdvert()
    {
        return new Advert([
            'post_id' => '1', 
            'contact' => 'test@mail.ru', 
            'content' => 'content', 
            'end_date' => '2019-10-10 00:00:00', 
            'is_active' => 1
        ]);
    }
}