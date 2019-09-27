<?php

namespace Huangdijia\Ssdb\Tests;

use Huangdijia\Ssdb\Simple;
use PHPUnit\Framework\TestCase;

class SsdbTest extends TestCase
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new Simple('127.0.0.1', 8888, 2000);
    }
    public function test_single_set_and_get()
    {
        $key   = 'test';
        $value = time();

        $this->connection->set($key, $value);

        $cached = $this->connection->get($key);

        $this->assertEquals($cached, $value);
    }

    public function test_multi_set_and_get()
    {
        $this->connection->multi_set([
            'a' => 1,
            'b' => 2,
        ]);

        $cached = $this->connection->multi_get(['a', 'b']);

        $this->assertIsArray($cached);
        $this->assertEquals(count($cached), 2);
    }
}
