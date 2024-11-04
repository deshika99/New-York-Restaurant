@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ $staffMember->first_name }} {{ $staffMember->last_name }}</h2>
            <a href="{{ route('staff_management') }}" class="btn btn-primary float-end">Back to Staff Members</a>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $staffMember->id }}</p>
                <p><strong>First Name:</strong> {{ $staffMember->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $staffMember->last_name }}</p>
                <p><strong>Position:</strong> {{ $staffMember->position->name }}</p>
                <p><strong>Department:</strong> {{ $staffMember->department->name }}</p>
                <p><strong>Phone Number:</strong> {{ $staffMember->contact }}</p>
                <p><strong>Email:</strong> {{ $staffMember->email }}</p>
                <p><strong>Address:</strong> {{ $staffMember->address ?? 'N/A' }}</p>
                <p><strong>Date Hired:</strong> {{ $staffMember->date_hired }}</p>
                <p><strong>Shift Details:</strong> {{ $staffMember->shift_details }}</p>
                <p><strong>Notes:</strong> {{ $staffMember->notes ?? 'No notes available' }}</p>
                <p><strong>Status:</strong>
                    @if($staffMember->status)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif
                </p>

                <!-- Delete Apartment Button -->
                <form action="{{ route('staff.destroy', $staffMember->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Delete Member</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
@endsection