<?php

$autoloader = require(__DIR__ . '/../init_autoload.php');

$callback = function($record) {
            echo $record->identity;
        };

$header = new \Cif\Parser\Tokenizer\StringLength();

$stations = new \Cif\Parser\Tokenizer\StringLength();
$stations->addFields(array(
    'identity' => 1,
    'spaces1' => 4,
    'station_name' => 30,
    'cate_type' => 1,
    'tiploc_code' => 7,
    'sub_alpha_code' => 3,
    'spaces2' => 3,
    'alpha_code' => 3,
    'easting' => 5,
    'estimated' => 1,
    'northing' => 5,
    'change_time' => 2,
    'footnote' => 2,
    'spaces3' => 11,
));

$aliases = new \Cif\Parser\Tokenizer\StringLength();
$aliases->addFields(array(
    'identity' => 1,
    'spaces1' => 4,
    'station_name' => 30,
    'space' => 1,
    'alias_name' => 30,
    'spaces' => 16,
));

$parser = new \Cif\Parser\Parser();
$parser->setRecordIdentityLength(1)
        ->setCallback($callback)
        ->setHeaderTokenizer($header)
        ->addRecordTokenizer('A', $stations)
        ->addRecordTokenizer('L', $aliases)
        ->addRecordTokenizer('G', new \Cif\Parser\Tokenizer\Ignore())
        ->addRecordTokenizer('V', new \Cif\Parser\Tokenizer\Ignore())
        ->addRecordTokenizer('Z', new \Cif\Parser\Tokenizer\Stop())
        ->parseFile(__DIR__ . '/stations.cif');