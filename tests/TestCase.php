<?php

namespace Tests;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,WithFaker ;

    protected  function setUp(): void
    {
        parent::setUp();
        if (config('app.env') !== 'testing') {
            $this->fail('Not in testing environment according to APP_ENV. Aborting');
            die(1);
        }

        $this->artisan('migrate:refresh');
        Storage::fake('public');
        $this->artisan('db:seed');
//        $this->faker = Factory::create();
        $this->admin = User::where('email', 'admin@admin.com')->first();
        //        $this->withoutExceptionHandling();
//        $this->withExceptionHandling();
    }

}
