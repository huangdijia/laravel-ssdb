<?php

namespace Huangdijia\Ssdb;

class Simple extends Ssdb
{
    public function __construct($host, $port, $timeout_ms = 2000)
    {
        parent::__construct($host, $port, $timeout_ms);
        $this->easy();
    }
}
