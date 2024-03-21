<?php

use App\Http\Controllers\Api\Admin\TourController;
use App\Http\Requests\TourRequest;
use App\Models\Travel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;

uses(DatabaseTransactions::class);

it('can create a tour', function () {

    $travel = Travel::factory()->create();
    // Create a request with the required data
    $requestData = [
        'name' => 'Test Tour',
        'startDate' => '2022-01-01',
        'endDate' => '2022-01-07',
        'price' => 1000,
        'travelId' => $travel->id, // Create a Travel instance and use its ID
    ];
    $request = TourRequest::create('/api/admin/tour/create', 'POST', $requestData);

    // Mock the TourController instance
    $controller = new TourController();

    // Call the store method
    $response = $controller->store($request);

    // Assert that the response is a JSON response with status code 201
    expect($response)->toBeInstanceOf(JsonResponse::class);
    expect($response->getStatusCode())->toBe(201);

    // Assert that the tour was created in the database
    $this->assertDatabaseHas('tours', $requestData);
});