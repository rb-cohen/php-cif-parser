<?php

namespace Cif\Parser\Field;

class Field {

    public $start;
    public $length;

    public function __construct($start, $length) {
        $this->start = $start;
        $this->length = $length;
    }

    public function extract($string) {
        $value = substr($string, $this->start, $this->length);
        return $value;
    }

}