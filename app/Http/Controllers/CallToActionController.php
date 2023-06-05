<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCallToActionRequest;
use App\Http\Requests\UpdateCallToActionRequest;
use App\Models\CallToAction;

class CallToActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCallToActionRequest $request)
    {
        $validated = $request->validated();
        $callToAction = CallToAction::create($validated);

        return response()->json($callToAction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CallToAction $callToAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CallToAction $callToAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCallToActionRequest $request, CallToAction $callToAction)
    {
        $validated = $request->validated();
        $callToAction->update($validated);

        return response()->json($callToAction, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallToAction $callToAction)
    {
        $callToAction->delete();

        return response()->json(null, 204);
    }
}
