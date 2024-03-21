<?php

use App\Http\Controllers\Api\Admin\TourController;
use App\Http\Requests\TourRequest;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;

it('can create a tour', function () {

    // Create a request with the required data
    $requestData = Tour::factory()->make()->toArray();

    $request = TourRequest::create('/api/admin/tour/create', 'POST', $requestData);

    // Mock the TourController instance
    $controller = new TourController;

    // Call the store method
    $response = $controller->store($request);

    // Assert that the response is a JSON response with status code 201
    expect($response)->toBeInstanceOf(JsonResponse::class);
    expect($response->getStatusCode())->toBe(201);
});
