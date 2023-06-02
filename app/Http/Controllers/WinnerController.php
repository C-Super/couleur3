<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWinnerRequest;
use App\Http\Requests\UpdateWinnerRequest;
use App\Models\Winner;

class WinnerController extends Controller
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
    public function store(StoreWinnerRequest $request)
    {
        $validated = $request->validated();
        $winner = Winner::create($validated);

        return response()->json($winner, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Winner $winner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Winner $winner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWinnerRequest $request, Winner $winner)
    {
        $validated = $request->validated();
        $winner->update($validated);

        return response()->json($winner, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Winner $winner)
    {
        $winner->delete();

        return response()->json(null, 204);
    }
}
