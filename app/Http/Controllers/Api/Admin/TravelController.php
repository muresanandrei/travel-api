<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function store(TravelRequest $request): JsonResponse
    {
        $travelFields = $request->safe()->only(['isPublic', 'name', 'description', 'numberOfDays', 'moods']);

        $travel = Travel::create($travelFields);

        return response()->json(['travel' => $travel], 201);
    }

    public function update(Request $request, Travel $travel): JsonResponse
    {
        $travel->name = $request->name;
        $travel->description = $request->description;
        $travel->save();

        return response()->json(['success' => true], 200);
    }
}
