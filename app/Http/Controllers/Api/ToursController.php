<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursPaginatedRequest;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class ToursController extends Controller
{
    protected $travel;

    public function __construct(Travel $travel)
    {
       $this->travel = $travel;
    }

    public function index(ToursPaginatedRequest $request) : JsonResponse
    {
        $filters = $request->all();
       
        $tours = $this->travel->getPaginatedToursBySlug($filters);

        return response()->json(['tours' => $tours], 200);
    }
}
