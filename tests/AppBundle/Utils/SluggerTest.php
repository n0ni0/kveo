<?php

namespace Tests\AppBundle\Utils;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Utils\Slugger;

class SluggerTest extends WebTestCase
{
    public function testSlugify()
    {
        $string        = 'hello world';
        $stringSlugify = 'hello-world';

        $slugger = new Slugger();
        $result  = $slugger->slugify($string);

        $this->assertEquals($result, $stringSlugify);

    }
}