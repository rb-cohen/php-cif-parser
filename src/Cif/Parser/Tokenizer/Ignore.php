<?php

namespace Cif\Parser\Tokenizer;

class Ignore implements TokenizerInterface {

    public function parse($string) {
        return null;
    }

}