<?php

use App\Http\Requests\ToursPaginatedRequest;
use App\Models\Tour;
use Mockery\MockInterface;

use function Pest\Laravel\getJson;
use function Pest\Laravel\mock;

it('returns paginated tours', function () {
    // Mock the ToursPaginatedRequest instance
    mock(ToursPaginatedRequest::class, function (MockInterface $mock) {
        $mock->shouldReceive('all')->andReturn([]);
    });

    // Mock the getPaginatedToursByTravelSlug method of the Tour model
    $mockedTours = Tour::factory()->count(10)->create();
    mock(Tour::class)->shouldReceive('getPaginatedToursByTravelSlug')->andReturn($mockedTours);

    // Call the index endpoint of the ToursController
    $response = getJson(route('api.tours.index'));

    // Assert that the response is a JSON response with status code 200
    $response->assertStatus(200);

    // Assert that the response contains the paginated tours
    $response->assertJsonStructure(['tours']);
    $response->assertJsonCount(10, 'tours'); // Assuming 10 tours per page
});

//test price filters
it('returns paginated tours with price filters', function () {
    // Mock the ToursPaginatedRequest instance
    mock(ToursPaginatedRequest::class, function (MockInterface $mock) {
        $mock->shouldReceive('all')->andReturn([
            'priceFrom' => 100,
            'priceTo' => 200,
        ]);
    });

    // Mock the getPaginatedToursByTravelSlug method of the Tour model
    $mockedTours = Tour::factory()->count(10)->create();
    mock(Tour::class)->shouldReceive('getPaginatedToursByTravelSlug')->andReturn($mockedTours);

    // Call the index endpoint of the ToursController
    $response = getJson(route('api.tours.index'));

    // Assert that the response is a JSON response with status code 200
    $response->assertStatus(200);

    // Assert that the response contains the paginated tours
    $response->assertJsonStructure(['tours']);
    $response->assertJsonCount(10, 'tours'); // Assuming 10 tours per page
});

//test date filters
it('returns paginated tours with date filters', function () {
    // Mock the ToursPaginatedRequest instance
    mock(ToursPaginatedRequest::class, function (MockInterface $mock) {
        $mock->shouldReceive('all')->andReturn([
            'dateFrom' => '2022-01-01',
        ]);
    });

    // Mock the getPaginatedToursByTravelSlug method of the Tour model
    $mockedTours = Tour::factory()->count(10)->create();
    mock(Tour::class)->shouldReceive('getPaginatedToursByTravelSlug')->andReturn($mockedTours);

    // Call the index endpoint of the ToursController
    $response = getJson(route('api.tours.index'));

    // Assert that the response is a JSON response with status code 200
    $response->assertStatus(200);

    // Assert that the response contains the paginated tours
    $response->assertJsonStructure(['tours']);
    $response->assertJsonCount(10, 'tours'); // Assuming 10 tours per page
});
