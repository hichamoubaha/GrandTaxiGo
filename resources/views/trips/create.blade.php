@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Book a Trip</h2>

    <form action="{{ route('trips.store') }}" method="POST">
        @csrf

        <label>Pickup Location:</label>
        <input type="text" name="pickup_location" class="form-control" required>

        <label>Destination:</label>
        <input type="text" name="destination" class="form-control" required>

        <label>Pickup Date:</label>
        <input type="datetime-local" name="pickup_date" class="form-control" required>

        <button type="submit" class="btn btn-primary mt-3">Book Now</button>
    </form>
</div>
@endsection
