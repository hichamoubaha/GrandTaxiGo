@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Set Availability</h2>

    <form action="{{ route('drivers.availability.store') }}" method="POST">
        @csrf

        <label>Location:</label>
        <input type="text" name="location" class="form-control" required>

        <label>Available From:</label>
        <input type="datetime-local" name="available_from" class="form-control" required>

        <label>Available Until:</label>
        <input type="datetime-local" name="available_until" class="form-control" required>

        <button type="submit" class="btn btn-primary mt-3">Set Availability</button>
    </form>
</div>
@endsection
