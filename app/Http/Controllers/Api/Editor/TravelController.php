<?php

namespace App\Http\Controllers\Api\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;

class TravelController extends Controller
{
    public function update(TravelRequest $request, $travelId): JsonResponse
    {
        $travel = Travel::findOrFail($travelId);
        $travelFields = $request->safe()->only(['isPublic', 'name', 'description', 'numberOfDays', 'moods']);
        $travel->update($travelFields);

        return response()->json(['success' => true], 200);
    }
}
