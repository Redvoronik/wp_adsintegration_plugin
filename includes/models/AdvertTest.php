<?php
require_once 'Advert.php';

use PHPUnit\Framework\TestCase;
use Advert;

class AdvertTest extends TestCase
{
    public function testCreate()
    {
        $advert = $this->initAdvert();

        $this->assertTrue(!empty($advert));
    }

    public function testSave()
    {
        $advert = $this->initAdvert();

        $this->assertTrue($advert->save());
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