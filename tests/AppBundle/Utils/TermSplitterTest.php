<?php

namespace Tests\AppBundle\Utils;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Utils\TermSplitter;

class TermSplitterTest extends WebTestCase
{
    public function testSplitter()
    {
        $string         = 'Be water my friend ;)';
        $stringSplitted = array('be', 'water', 'my', 'friend');

        $splitter = new TermSplitter();
        $result = $splitter->splitIntoTerms($string, $minTermLength = 2);

        $this->assertEquals($result, $stringSplitted);
    }
}