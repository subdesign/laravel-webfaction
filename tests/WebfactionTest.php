<?php

namespace Subdesign\LaravelWebfaction\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Subdesign\LaravelWebfaction\Exceptions\WebfactionException;
use Subdesign\LaravelWebfaction\Facades\Webfaction;
use Subdesign\LaravelWebfaction\Tests\TestCase;

class WebfactionTest extends TestCase
{
    /** @test */
    public function api_can_be_instantiated()
    {
        $instance = new Webfaction;

        $this->assertInstanceOf(Webfaction::class, $instance);
    }

    /** @test */
    public function helper_function_exists()
    {
        $this->assertTrue(function_exists('Webfaction'));

        $this->assertInstanceOf('Subdesign\LaravelWebfaction\Webfaction', webfaction());
    }

    /** @test */
    public function cannot_call_login_method_directly()
    {
        $this->expectException(WebfactionException::class);

        Webfaction::login();
    }

    /** @test */
    public function invalid_api_callback_drops_exception()
    {
        $this->expectException(WebfactionException::class);

        Webfaction::not_existent_callback();
    }
}
