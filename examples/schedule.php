<?php

$autoloader = require(__DIR__ . '/../vendor/autoload.php');

$callback = function($record) {
            echo $record->identity;
        };

$header = new \Cif\Parser\Tokenizer\Ignore();

$associations = new \Cif\Parser\Tokenizer\StringLength();
$associations->addFields(array(
    'identity' => 2,
    'transaction' => 1,
    'train_uid' => 6,
    'associated_train_uid' => 6,
    'association_start_date' => 6,
    'association_end_date' => 6,
    'association_days' => 7,
    'association_category' => 2,
    'association_date_ind' => 1,
    'association_location' => 7,
    'base_location_suffix' => 1,
    'association_location_suffix' => 1,
    'diagram_type' => 1,
    'association_type' => 1,
    'space' => 31,
    'stp_indicator' => 1,
));

$parser = new \Cif\Parser\Parser();
$parser->setRecordIdentityLength(2)
        ->setCallback($callback)
        ->setHeaderTokenizer($header)
        ->addRecordTokenizer('TI', new \Cif\Parser\Tokenizer\Ignore())
        ->addRecordTokenizer('TA', new \Cif\Parser\Tokenizer\Ignore())
        ->addRecordTokenizer('TD', new \Cif\Parser\Tokenizer\Ignore())
        ->addRecordTokenizer('ZZ', new \Cif\Parser\Tokenizer\Stop())
        ->addRecordTokenizer('AA', $associations)
        ->parseFile(__DIR__ . '/schedule.cif');