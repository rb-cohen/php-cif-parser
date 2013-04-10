<?php

switch (true){
    case class_exists('\Cif\Parser\Parser', false):
        return false;
    case file_exists(__DIR__ . '/vendor/autoload.php'):
        return include_once __DIR__ . '/vendor/autoload.php';
        break;
    case file_exists(__DIR__ . '/../../autoload.php'):
        return include_once __DIR__ . '/../../autoload.php';
        break;
    default:
        throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}