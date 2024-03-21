<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursPaginatedRequest;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;

class ToursController extends Controller
{
    protected $tour;

    public function __construct(Tour $tour)
    {
        $this->tour = $tour;
    }

    public function index(ToursPaginatedRequest $request): JsonResponse
    {
        $filters = $request->all();

        $tours = $this->tour->getPaginatedToursByTravelSlug($filters);

        return response()->json(['tours' => $tours], 200);
    }
}
