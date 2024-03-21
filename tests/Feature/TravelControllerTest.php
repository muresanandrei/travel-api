<?php 

use App\Http\Controllers\Api\Admin\TravelController;
use App\Http\Requests\TravelRequest;
use Illuminate\Http\JsonResponse;

it('can create a travel', function () {
    // Mock request data
    $requestData = [
        'isPublic' => 1,
        'name' => 'Testing Travel',
        'description' => 'This is a test travel description.',
        'numberOfDays' => 7,
        'moods' => [
            'nature' => 80,
            'relax' => 20,
            'history' => 90,
            'culture' => 30,
            'party' => 10
        ]
    ];
    // Create a mock request object
    $request = TravelRequest::create('/api/admin/travel/create', 'POST', $requestData);

    // Create an instance of the controller
    $controller = new TravelController();

    // Call the store method with the mock request
    $response = $controller->store($request);

      // Assert that the response is a JSON response with status code 201
      expect($response)->toBeInstanceOf(JsonResponse::class);
      expect($response->getStatusCode())->toBe(201);
  
      // Assert that the tour was created in the database
      $this->assertDatabaseHas('travels', $requestData);
});