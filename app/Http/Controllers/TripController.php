<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function reserveTrip(Request $request)
{
    $validated = $request->validate([
        'pickup_location' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'pickup_date' => 'required|date|after:now',
    ]);

    $trip = Trip::create([
        'user_id' => auth()->id(),
        'pickup_location' => $validated['pickup_location'],
        'destination' => $validated['destination'],
        'pickup_date' => $validated['pickup_date'],
        'status' => 'reserved',
    ]);

    return redirect()->route('trip.history');
}

}
