<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SlotStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slots = Slot::where('status', SlotStatus::Available)-> get();
        return view('admin.reservations.create', compact('slots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        $slot = Slot::findOrFail($request->slot_id);
        $request_date = Carbon::parse($request->res_date);

        foreach ($slot->reservations as $res) {
         $resDate = Carbon::parse($res->res_date);

    if ($resDate->format('Y-m-d') == $request_date->format('Y-m-d')) {
        return back()->with('warning', 'This Court Slot is reserved for this date.');
    }
        }


        Reservation::create($request->validated());

        return to_route('admin.reservation.index')->with('success','Reservation created successfully.');
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
    public function edit(Reservation $reservation)
    {
        $slots = Slot::where('status', SlotStatus::Available)-> get();
        return view('admin.reservations.edit', compact('reservation', 'slots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
{
    $slot = Slot::findOrFail($request->slot_id);
    $request_date = Carbon::parse($request->res_date);

    $reservations = $slot->reservations()->where('id', '!=', $reservation->id)->get();
    foreach ($reservations as $res) {
        $resDate = Carbon::parse($res->res_date);

        if ($resDate->format('Y-m-d') == $request_date->format('Y-m-d')) {
            return back()->with('warning', 'This Court Slot is reserved for this date.');
        }
    }

    $reservation->update($request->validated());
    return to_route('admin.reservation.index')->with('success', 'Reservation updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return to_route('admin.reservation.index')->with('danger', 'Reservation deleted successfully.');
    }
}
