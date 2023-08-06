<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlotStoreRequest;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slots = Slot::all();
        return view('admin.slots.index', compact('slots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlotStoreRequest $request)
    {
        Slot::create([
            'name' => $request->name,
            'status' => $request->status,
            'location' => $request->location, 
        ]);

        return to_route('admin.slots.index')->with('success','Slot created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slot $slot)
    {
        return view('admin.slots.edit', compact('slot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlotStoreRequest $request, Slot $slot)
    {
        $slot->update($request->validated());

        return to_route('admin.slots.index')->with('success','Slot updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        $slot->reservations()->delete();
        $slot->delete();
        return to_route('admin.slots.index')->with('danger','Slot deleted successfully.');
    }
}
