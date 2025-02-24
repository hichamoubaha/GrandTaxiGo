<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\DriverAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Show available drivers.
     */
    public function index()
    {
        $drivers = DriverAvailability::where('is_available', true)->with('driver')->get();
        return view('trips.index', compact('drivers'));
    }

    /**
     * Store a new trip request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pickup_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'pickup_date' => 'required|date|after:now',
            'driver_id' => 'nullable|exists:users,id',
        ]);

        Trip::create([
            'user_id' => Auth::id(),
            'driver_id' => $request->driver_id,
            'pickup_location' => $request->pickup_location,
            'destination' => $request->destination,
            'pickup_date' => $request->pickup_date,
            'status' => 'pending',
        ]);

        return redirect()->route('trips.history')->with('success', 'Trip request sent!');
    }

    /**
     * Show trip history.
     */
    public function history()
    {
        $trips = Trip::where('user_id', Auth::id())->orWhere('driver_id', Auth::id())->get();
        return view('trips.history', compact('trips'));
    }

    /**
     * Accept a trip (Driver).
     */
    public function accept(Trip $trip)
    {
        if (Auth::id() !== $trip->driver_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        $trip->update(['status' => 'reserved']);
    
        return redirect()->route('trips.history')->with('success', 'Trip accepted.');
    }
    
    public function reject(Trip $trip)
    {
        if (Auth::id() !== $trip->driver_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        $trip->update(['status' => 'cancelled']);
    
        return redirect()->route('trips.history')->with('success', 'Trip rejected.');
    }
    
    /**
     * Cancel a trip.
     */
    public function cancel(Trip $trip)
    {
        if (Auth::id() !== $trip->user_id && Auth::id() !== $trip->driver_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $trip->update(['status' => 'cancelled']);

        return redirect()->route('trips.history')->with('success', 'Trip cancelled.');
    }
}
