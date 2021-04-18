<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\BrowserKitTesting\TestCase as BrowserTest;

abstract class TestCase extends BrowserTest
{
    use CreatesApplication;
    protected $baseUrl = 'http://cimsolutions.test';
}
