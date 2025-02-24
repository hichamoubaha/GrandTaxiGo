<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverAvailabilityController extends Controller
{
    public function updateAvailability(Request $request)
{
    $validated = $request->validate([
        'available_from' => 'required|date',
        'available_to' => 'required|date|after:available_from',
    ]);

    DriverAvailability::updateOrCreate(
        ['driver_id' => auth()->id()],
        $validated
    );

    return back();
}

}
