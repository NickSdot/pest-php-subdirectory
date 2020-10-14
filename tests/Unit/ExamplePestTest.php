<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;


// Uses the given test case in the "Feature" folder recursively
uses(TestCase::class);
uses(RefreshDatabase::class);


it('any test')->assertTrue(true);


it('asserts true is true', function () {

    $this->assertTrue(true);

    expect(true)->toBeTrue();
});


it('asserts false is false', function () {

    $this->assertTrue(true);

    expect(false)->toBeFalse();
});

