<?php

namespace Cif\Parser\Tokenizer;

use Cif\Parser\Field\Field;
use Cif\Parser\Record;

class StringLength implements TokenizerInterface {

    protected $fields = array();

    public function __construct(array $fields = array()) {
        $this->addFields($fields);
    }

    public function addFields(array $fields) {
        $start = 0;
        foreach ($fields as $name => $length) {
            if (is_numeric($length)) {
                $field = new Field($start, $length);
            }

            $this->addField($name, $field);
            $start += $field->length;
        }

        return $this;
    }

    public function addField($name, Field $field) {
        $this->fields[$name] = $field;
        return $this;
    }

    public function setCallback(callable $callback) {
        $this->callback = $callback;
        return $this;
    }

    public function parse($string) {
        $record = new Record;

        foreach ($this->fields as $name => $field) {
            $record->$name = $field->extract($string);
        }

        return $record;
    }

}