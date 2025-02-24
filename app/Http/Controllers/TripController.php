<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TripController extends Controller
{
    /**
     * Show all trips for the logged-in user (history for passengers & drivers).
     */
    public function index()
    {
        $user = Auth::user();

        // Get trips based on user role
        $trips = ($user->role === 'passenger') 
            ? Trip::where('user_id', $user->id)->get() 
            : Trip::where('driver_id', $user->id)->get();

        return view('trips.index', compact('trips'));
    }

    /**
     * Show the form to book a trip.
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Store a new trip reservation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'pickup_date' => 'required|date|after:now',
        ]);

        Trip::create([
            'user_id' => Auth::id(),
            'pickup_location' => $request->pickup_location,
            'destination' => $request->destination,
            'pickup_date' => Carbon::parse($request->pickup_date),
            'status' => 'reserved',
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip booked successfully!');
    }

    /**
     * Cancel a trip (only before departure).
     */
    public function destroy(Trip $trip)
    {
        if (Auth::id() !== $trip->user_id || Carbon::now()->gt($trip->pickup_date)) {
            return redirect()->route('trips.index')->with('error', 'You cannot cancel this trip.');
        }

        $trip->update(['status' => 'cancelled']);

        return redirect()->route('trips.index')->with('success', 'Trip cancelled successfully.');
    }
}
