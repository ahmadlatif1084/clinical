<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Box;

class BasicTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testHasItemInBox()
    {
        $box = new Box(['cat', 'toy', 'torch']);

        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }


    public function testTakeOneFromTheBox()
    {
        $box = new Box(['torch']);
        $this->assertEquals('torch', $box->takeOne());
//        print_r($box->takeOne());
        // Null, now the box is empty
       $this->assertNull($box->takeOne());
    }

    public function testStartsWithALetter()
    {
        $box = new Box(['toy', 'torch', 'ball', 'cat', 'tissue']);

        $results = $box->startsWith('t');

        $this->assertCount(3, $results);
        $this->assertContains('toy', $results);
        $this->assertContains('torch', $results);
        $this->assertContains('tissue', $results);

        // Empty array if passed even
        $this->assertEmpty($box->startsWith('s'));
    }

}
