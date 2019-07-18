<?php
/**
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Buddy\Tests;

use Buddy\Buddy;
use PHPUnit\Framework\TestCase;

class BuddyTest extends TestCase
{
    public function testInstantiating()
    {
        $buddy = new Buddy();
        $this->assertInstanceOf('Buddy\Buddy', $buddy);
        $this->assertTrue(method_exists($buddy, 'add'));
        $this->assertTrue(method_exists($buddy, 'sub'));
    }

    public function testAdd()
    {
        $buddy = new Buddy();
        $this->assertEquals(3, $buddy->add(1, 2));

    }

    public function testAddWrongV1()
    {
        $this->expectException('v1 is not an integer');
        $buddy = new Buddy();
        $buddy->add('1', 2);
    }

    public function testAddWrongV2()
    {
        $this->expectException('v2 is not an integer');
        $buddy = new Buddy();
        $buddy->add(1, '2');
    }

    public function testSub()
    {
        $buddy = new Buddy();
        $this->assertEquals(1, $buddy->sub(3, 2));

    }

    public function testFib()
    {
        $buddy = new Buddy();
        $this->assertEquals(0, $buddy->fib(0));
        $this->assertEquals(1, $buddy->fib(1));
        $this->assertEquals(4, $buddy->fib(5));
        $this->assertEquals(10, $buddy->fib(55));
    }

    public function testSubWrongV1()
    {
        $this->expectException('v1 is not an integer');
        $buddy = new Buddy();
        $buddy->sub('3', 2);
    }

    public function testSubWrongV2()
    {
        $this->expectException('v2 is not an integer');
        $buddy = new Buddy();
        $buddy->sub(3, '2');
    }

    public function testFibOffline()
    {
        $this->expectException('fib service is offline');
        $buddy = new Buddy('http://localhost:1234');
        $buddy->fib(1);
    }

    public function testFibWrongN()
    {
        $this->expectException('n is not an integer');
        $buddy = new Buddy();
        $buddy->fib('1');
    }

    public function testFibNLessThan0()
    {
        $this->expectException('n must be greater or equal 0');
        $buddy = new Buddy();
        $buddy->fib(-1);
    }
}