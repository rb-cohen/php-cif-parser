<?php

namespace CifTest\Parser;

use Cif\Parser\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase {
    
    public function testParseFile(){
        $record = $this->getMock('\Cif\Parser\Record');
        $parser = $this->getMock('\Cif\Parser\Parser', array('parseHeader', 'parseLine'));
        $parser->expects($this->once())
                ->method('parseHeader')
                ->with("header\n")
                ->will($this->returnValue(true));
        $parser->expects($this->at(1))
                ->method('parseLine')
                ->with("line1\n")
                ->will($this->returnValue(true));
        $parser->expects($this->at(2))
                ->method('parseLine')
                ->with("line2")
                ->will($this->returnValue(true));
        
        $file = 'data:text/plain,header' . "\n" . 'line1' . "\n" . 'line2';        
        $parser->parseFile($file);
    }
    
    /**
     * @depends testParseFile
     */
    public function testParseFileStopsOnFalse(){
        $parser = $this->getMock('\Cif\Parser\Parser', array('parseHeader', 'parseLine'));
        $parser->expects($this->once())
                ->method('parseLine')
                ->with("line1\n")
                ->will($this->returnValue(false));
        
        $file = 'data:text/plain,header' . "\n" . 'line1' . "\n" . 'line2';        
        $parser->parseFile($file);
    }
    
}