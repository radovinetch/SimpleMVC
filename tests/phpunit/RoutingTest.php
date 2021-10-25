<?php


namespace SimpleMvc\tests;


use PHPUnit\Framework\TestCase;
use SimpleMvc\routing\Route;
use SimpleMvc\routing\Routing;
use SimpleMvc\session\Session;
use SimpleMvc\Utils;

class RoutingTest extends TestCase
{
    public function testRegister()
    {
        (new Routing()); // creating routing
        $this->assertInstanceOf(Route::class, Routing::get('/tasks', 'TaskController@index'));
    }
}