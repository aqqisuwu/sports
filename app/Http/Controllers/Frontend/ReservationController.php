<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\SlotStatus;
use App\Http\Controllers\Controller;
use App\Mail\ReservationConfirmation;
use App\Models\Reservation;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function stepOne(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addMonth();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request)
{
    $validated = $request->validate([
        "first_name" => ['required'],
        "last_name" => ['required'],
        "student_id" => ['required'],
        "email" => ['required'],
        "tel_number" => ['required'],
        "res_date" => ['required'],
    ]);

    if (empty($request->session()->get('reservation'))) {
        $reservation = new Reservation();
        $reservation->fill($validated);
        $request->session()->put('reservation', $reservation);
    } else {
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $request->session()->put('reservation', $reservation);
    }

    // Update the start_time and end_time attributes based on the selected reservation date
    $reservation->start_time = Carbon::parse($reservation->res_date);
    $reservation->end_time = $reservation->start_time->copy()->addHour();

    // Save the reservation
    $reservation->save();

    return to_route('reservations.step.two');
}

    public function stepTwo(Request $request)
{
    $reservation = $request->session()->get('reservation');

    if (!$reservation) {
        // Handle the case where $reservation is null or not set in the session
        // You can redirect the user back to the previous step or display an error message
        return redirect()->back()->with('error', 'Reservation data not found.');
    }

    $reservationsWithin1Hour = Reservation::whereBetween('res_date', [
        $reservation->start_time->subHour(),
        $reservation->end_time->addHour()
    ])->get();

    $unavailableSlots = $reservationsWithin1Hour->pluck('slot_id');

    $slots = Slot::where('status', SlotStatus::Available)
        ->whereNotIn('id', $unavailableSlots)
        ->get();

    return view('reservations.step-two', compact('reservation', 'slots'));
}



public function storeStepTwo(Request $request)
{
    $validated = $request->validate([
        'slot_id' => ['required']
    ]);

    $reservation = $request->session()->get('reservation');

    if (!$reservation) {
        // Handle the case where $reservation is null or not set in the session
        // You can redirect the user back to the previous step or display an error message
        return redirect()->back()->with('error', 'Reservation data not found.');
    }

    $selectedSlot = Slot::findOrFail($validated['slot_id']);

    // Check if the selected slot is available
    if ($selectedSlot->status !== SlotStatus::Available) {
        return redirect()->back()->with('error', 'The selected slot is not available.');
    }

    // Set the slot_id, start_time, and end_time attributes of the reservation
    $reservation->slot_id = $selectedSlot->id;
    $reservation->start_time = $selectedSlot->start_time;
    $reservation->end_time = $selectedSlot->end_time;

    $reservation->save();
    $request->session()->forget('reservation');

    // Send confirmation email
    Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));

    return redirect()->route('thankyou');
}



    
}
