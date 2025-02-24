@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Trips</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Pickup Location</th>
                <th>Destination</th>
                <th>Pickup Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
                <tr>
                    <td>{{ $trip->pickup_location }}</td>
                    <td>{{ $trip->destination }}</td>
                    <td>{{ $trip->pickup_date }}</td>
                    <td>{{ ucfirst($trip->status) }}</td>
                    <td>
                        @if($trip->status === 'reserved' && now()->lt($trip->pickup_date))
                            <form action="{{ route('trips.destroy', $trip->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
