<?php

namespace Tests\Feature\Api\Editor;

use App\Http\Controllers\Api\Editor\TravelController;
use App\Http\Requests\TravelRequest;
use App\Models\Travel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Mockery;

uses(DatabaseTransactions::class);

it('can update a travel', function () {
    // Create a travel instance
    $travel = Travel::factory()->create();

    $travelId = 'dummy_travel_id'; // Provide a dummy travel ID

    // Define the travel data to update
    $updatedData = [
        'isPublic' => true,
        'name' => 'Updated Travel Name',
        'description' => 'Updated travel description',
        'numberOfDays' => 10,
        'moods' => ['nature' => 70, 'relax' => 50, 'history' => 80, 'culture' => 60, 'party' => 40],
    ];

    // Create a mock request with the updated data
    $request = Mockery::mock(TravelRequest::class);
    $request->shouldReceive('safe')->andReturnSelf();
    $request->shouldReceive('only')->andReturn($updatedData);

    // Mock the Travel model
    $travelMock = Mockery::mock(Travel::class);

    // Mock the findOrFail method to return the mock travel instance
    $travelMock->shouldReceive('findOrFail')->with($travel->id)->andReturn($travel);

    // Bind the mock instance to the Travel class
    app()->instance(Travel::class, $travelMock);

    // Create a new instance of the TravelController
    $controller = new TravelController;

    // Call the update method
    $response = $controller->update($request, $travel->id);

    // Assert that the response is a JSON response with status code 200
    expect($response)->toBeInstanceOf(JsonResponse::class);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getData())->toEqual((object) ['success' => true]);
});

// Ensure to add any necessary tear down after the test
afterEach(function () {
    Mockery::close();
});
