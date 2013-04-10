<?php

namespace Cif\Parser\Tokenizer;

class Stop implements TokenizerInterface {

    public function parse($string) {
        return false;
    }

}