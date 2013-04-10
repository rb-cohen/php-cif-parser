<?php

namespace Cif\Parser;

class Parser {

    public $recordIdentityLength = 2;
    protected $headerTokenizer;
    protected $recordTokenizers;
    protected $callback;
    protected $stop = false;

    /**
     * 
     * @param string $filename
     * @return \Cif\Parser\Parser
     */
    public function parseFile($filename) {
        $handle = fopen($filename, "r");
        if ($handle) {
            $i = 0;
            while (($buffer = fgets($handle)) !== false) {
                $result = ($i > 0) ? $this->parseLine($buffer) : $this->parseHeader($buffer);

                if ($result === false) {
                    break;
                }

                $i++;
            }

            fclose($handle);
        }

        return $this;
    }

    /**
     * 
     * @param string $string
     * @return \Cif\Parser\Parser
     */
    public function parseHeader($string) {
        $this->headerTokenizer->parse($string);
        return $this;
    }

    /**
     * 
     * @param string $string
     * @return \Cif\Parser\Parser
     */
    public function parseLine($string) {
        try {
            $identity = substr($string, 0, $this->recordIdentityLength);
            $parser = $this->getRecordTokenizer($identity);
            $record = $parser->parse($string);
        } catch (Exception $e) {
            throw new Exception('Failed parsing line ' . $string . ' because: ' . $e->getMessage(), null, $e);
        }

        if ($record) {
            call_user_func(($this->callback)? : array($this, 'printRecord'), $record);
        }

        return $record;
    }

    /**
     * 
     * @param \Cif\Parser\Record $record
     * @return \Cif\Parser\Parser
     */
    public function printRecord(Record $record) {
        echo $record . PHP_EOL;
        return $this;
    }

    /**
     * 
     * @param int $length
     * @return \Cif\Parser\Parser
     */
    public function setRecordIdentityLength($length) {
        $this->recordIdentityLength = (int) $length;
        return $this;
    }

    /**
     * 
     * @param callable $callback
     * @return \Cif\Parser\Parser
     */
    public function setCallback(callable $callback) {
        $this->callback = $callback;
        return $this;
    }

    /**
     * 
     * @param \Cif\Parser\Tokenizer\TokenizerInterface $headerParser
     * @return \Cif\Parser\Parser
     */
    public function setHeaderTokenizer(Tokenizer\TokenizerInterface $headerTokenizer) {
        $this->headerTokenizer = $headerTokenizer;
        return $this;
    }

    /**
     * 
     * @param string $identity
     * @param \Cif\Parser\Tokenizer\TokenizerInterface $recordTokenizer
     * @return \Cif\Parser\Parser
     */
    public function addRecordTokenizer($identity, Tokenizer\TokenizerInterface $recordTokenizer) {
        if (strlen($identity) !== $this->recordIdentityLength) {
            throw new Exception('Record identity invalid length');
        }

        $this->recordTokenizers[$identity] = $recordTokenizer;
        return $this;
    }

    /**
     * 
     * @param string $identity
     * @return \Cif\Parser\Tokenizer\TokenizerInterface
     * @throws \Cif\Parser\Exception
     */
    public function getRecordTokenizer($identity) {
        if (!array_key_exists($identity, $this->recordTokenizers)) {
            throw new Exception("No parser registered for identity '$identity'");
        }

        return $this->recordTokenizers[$identity];
    }

}