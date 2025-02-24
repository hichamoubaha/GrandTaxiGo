@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Drivers</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Location</th>
                <th>Available From</th>
                <th>Available Until</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $availability)
                <tr>
                    <td>{{ $availability->driver->name }}</td>
                    <td>{{ $availability->location }}</td>
                    <td>{{ $availability->available_from }}</td>
                    <td>{{ $availability->available_until }}</td>
                    <td>
                        <form action="{{ route('trips.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="driver_id" value="{{ $availability->driver->id }}">
                            <input type="hidden" name="pickup_location" value="{{ $availability->location }}">
                            <label>Destination:</label>
                            <input type="text" name="destination" required>
                            <label>Pickup Date:</label>
                            <input type="datetime-local" name="pickup_date" required>
                            <button type="submit" class="btn btn-primary">Book Trip</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
