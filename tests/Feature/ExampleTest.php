<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\SessionOrderModel;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_session_cancel_function_success()
    {
        $this->seed();
        $test = (new SessionOrderModel())->CancelSession(1);
        $this->assertEquals(true,$test);
    }

    /** @test */
    public function test_session_cancel_function_fail()
    {
        $this->seed();
        $test = (new SessionOrderModel())->CancelSession(999);
        $this->assertEquals(false,$test);
    }

}

