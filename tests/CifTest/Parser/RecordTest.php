<?php

namespace CifTest\Parser;

use Cif\Parser\Record;

class RecordTest extends \PHPUnit_Framework_TestCase {
    
    public function testSetAndGet(){
        $record = new Record;
        $record->test = 1;
        
        $this->assertEquals(1, $record->test);
    }
    
}