<?php

namespace Huangdijia\Ssdb\Tests;

use Huangdijia\Ssdb\Simple;
use PHPUnit\Framework\TestCase;

class SsdbTest extends TestCase
{
    public static function connection()
    {
        static $connection = null;

        if (is_null($connection) || $connection->closed()) {
            $connection = new Simple('127.0.0.1', 8888, 2000);
        }

        return $connection;
    }

    public function test_single_set_and_get()
    {
        $key   = 'test';
        $value = time();

        self::connection()->set($key, $value);

        $cached = self::connection()->get($key);

        $this->assertEquals($cached, $value);
        $this->assertTrue(true);
    }

    public function test_multi_set_and_get()
    {
        self::connection()->multi_set([
            'a' => 1,
            'b' => 2,
        ]);

        $cached = self::connection()->multi_get(['a', 'b']);

        $this->assertIsArray($cached);
        $this->assertEquals(count($cached), 2);
    }
}
