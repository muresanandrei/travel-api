<?php

class TourController extends Controller
{
    public function store(TourRequest $request): JsonResponse
    {
        $tour = Tour::create($request->validated());

        return response()->json($tour, 201);
    }
}
