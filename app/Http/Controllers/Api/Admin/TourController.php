<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class TourController extends Controller
{
    public function store(TourRequest $request): JsonResponse
    {
        $tourFields = $request->safe()->only(['name', 'startDate', 'endDate', 'price', 'travelId']);

        $travel = Travel::findOrFail($tourFields['travelId']);
        $tour = $travel->tours()->create($tourFields);

        return response()->json(['tour' => $tour], 201);
    }
}
