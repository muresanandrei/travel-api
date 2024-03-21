<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class TravelController extends Controller
{
    public function store(TravelRequest $request): JsonResponse
    {
        $travelFields = $request->only(['isPublic', 'name', 'description', 'numberOfDays', 'moods']);

        $travel = Travel::create($travelFields);

        return response()->json(['travel' => $travel], 201);
    }
}
