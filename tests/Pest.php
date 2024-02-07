<?php

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

uses(
    Tests\TestCase::class
)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}

TestResponse::macro('assertSeeTitle', function (array|string $sections) {
    return $this->assertSee(sprintf('<title>%s</title>', title(Arr::wrap($sections))), false);
});

TestResponse::macro('assertSeeLink', function (string|array $url) {
    $url = is_array($url) ? route(...$url) : $url;

    return $this->assertSee("href=\"$url\"", false);
});

TestResponse::macro('assertDontSeeHxLink', function (string|array $url, string $method) {
    $url = is_array($url) ? route(...$url) : $url;

    return $this->assertDontSee("hx-$method=\"$url\"", false);
});

TestResponse::macro('assertSeeHxLink', function (string|array $url, string $method) {
    $url = is_array($url) ? route(...$url) : $url;

    return $this->assertSee("hx-$method=\"$url\"", false);
});

TestResponse::macro('assertSeeForm', function (string|array $action) {
    $action = is_array($action) ? route(...$action) : $action;

    return $this->assertSee("action=\"$action\"", false);
});

TestResponse::macro('assertSeeInput', function (string $name, ?string $value = null) {
    return $this->assertSee([
        $value ? "value=\"$value\"" : '',
        "name=\"$name\"",
    ], false);
});
