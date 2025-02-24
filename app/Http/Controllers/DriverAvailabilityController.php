<?php

namespace App\Http\Controllers;

use App\Models\DriverAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DriverAvailabilityController extends Controller
{
    /**
     * Show availability management for the driver.
     */
    public function index()
    {
        $availabilities = DriverAvailability::where('driver_id', Auth::id())->get();
        return view('drivers.availability.index', compact('availabilities'));
    }

    /**
     * Show form to create new availability.
     */
    public function create()
    {
        return view('drivers.availability.create');
    }

    /**
     * Store new availability.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'available_from' => 'required|date|after:now',
            'available_until' => 'required|date|after:available_from',
        ]);

        DriverAvailability::create([
            'driver_id' => Auth::id(),
            'location' => $request->location,
            'available_from' => Carbon::parse($request->available_from),
            'available_until' => Carbon::parse($request->available_until),
            'is_available' => true,
        ]);

        return redirect()->route('drivers.availability.index')->with('success', 'Availability set successfully!');
    }

    /**
     * Delete availability.
     */
    public function destroy(DriverAvailability $availability)
    {
        if (Auth::id() !== $availability->driver_id) {
            return redirect()->route('drivers.availability.index')->with('error', 'Unauthorized action.');
        }

        $availability->delete();

        return redirect()->route('drivers.availability.index')->with('success', 'Availability removed.');
    }
}
