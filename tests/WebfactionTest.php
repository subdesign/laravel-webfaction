<?php

namespace Subdesign\LaravelWebfaction\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Subdesign\LaravelWebfaction\Tests\TestCase;

class WebfactionTest extends TestCase
{
    /** test */    
    public function call_api()
    {       
        $this->assertEquals(1, 1);
    }
}
