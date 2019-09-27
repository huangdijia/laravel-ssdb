<?php

namespace Huangdijia\Ssdb\Tests;

use Huangdijia\Ssdb\Simple;
use PHPUnit\Framework\TestCase;

class SsdbTest extends TestCase
{
    public function test_connect()
    {
        $ssdb  = new Simple('127.0.0.1', 8888, 2000);
        $key   = 'test';
        $value = time();

        $ssdb->set($key, $value);

        $cached = $ssdb->get($key);

        $this->assertEquals($cached, $value);
    }
}
