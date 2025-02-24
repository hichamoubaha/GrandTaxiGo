@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Availability</h2>

    <a href="{{ route('drivers.availability.create') }}" class="btn btn-primary mb-3">Set Availability</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Location</th>
                <th>Available From</th>
                <th>Available Until</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($availabilities as $availability)
                <tr>
                    <td>{{ $availability->location }}</td>
                    <td>{{ $availability->available_from }}</td>
                    <td>{{ $availability->available_until }}</td>
                    <td>
                        <form action="{{ route('drivers.availability.destroy', $availability->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
