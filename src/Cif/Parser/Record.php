<?php

namespace Cif\Parser;

class Record {

    public $data = array();

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        return $this->data[$name];
    }

    public function toJson() {
        return json_encode($this->data);
    }

    public function __toString() {
        return $this->toJson();
    }

}