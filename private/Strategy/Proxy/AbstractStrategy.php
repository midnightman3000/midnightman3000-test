<?php

namespace Alex\Strategy\Proxy;

abstract class AbstractStrategy
{
    private $sources;
            
    public function __construct($sources) {
        $this->sources = $sources;
    }
    
    public function getSources()
    {
        return $this->sources;
    }
}