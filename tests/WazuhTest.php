<?php

namespace PG\Wazuh\Tests;

use PHPUnit\Framework\TestCase;
use PG\Wazuh\Wazuh;

class WazuhTest extends TestCase
{
    public function testCreateAddress()
    {
        $wazuh = new Wazuh('https://test.com');

        $segments = ['first', 'second'];

        $address = $wazuh->createAddress($segments);

        $this->assertSame('https://test.com/first/second', $address);
    }
}