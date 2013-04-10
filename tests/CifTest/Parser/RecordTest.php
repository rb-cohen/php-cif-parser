<?php

namespace CifTest\Parser;

use Cif\Parser\Record;

class RecordTest extends \PHPUnit_Framework_TestCase {
    
    public function testSetAndGet(){
        $record = new Record;
        $record->test = 1;
        
        $this->assertEquals(1, $record->test);
    }
    
    public function testToJson(){
        $record = new Record;
        $record->test = 1;
        $record->sample = 2;
        
        $this->assertEquals('{"test":1,"sample":2}', $record->toJson());
    }
    
    public function testToString(){
        $record = new Record;
        $record->test = 1;
        $record->sample = 2;
        
        $this->assertEquals($record->toJson(), (string) $record);
    }
    
}