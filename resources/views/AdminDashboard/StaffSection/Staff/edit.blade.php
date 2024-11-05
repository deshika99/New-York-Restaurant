@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Error Display -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Edit Staff Member</h2>
            <p>Update staff member's details</p>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('staff.update', $staffMember->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
<div class="row">
                    <!-- First Name -->
                    <div class="mb-4 col-md-6">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            placeholder="Type first name here"
                            class="form-control"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name', $staffMember->first_name) }}"
                            required />
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4 col-md-6">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            placeholder="Type last name here"
                            class="form-control"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name', $staffMember->last_name) }}"
                            required />
                    </div>

                    <!-- Position -->
                    <div class="mb-4 col-md-6">
                        <label for="position_id" class="form-label">Position/Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="position_id" name="position_id" required>
                            <option value="">Select position</option>
                            @foreach($positions as $position)
                            <option value="{{ $position->id }}"
                                {{ $staffMember->position_id == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department -->
                    <div class="mb-4 col-md-6">
                        <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                        <select class="form-select" id="department_id" name="department_id" required>
                            <option value="">Select department</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ $staffMember->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4 col-md-6">
                        <label for="contact" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            placeholder="Enter phone number"
                            class="form-control"
                            id="contact"
                            name="contact"
                            value="{{ old('contact', $staffMember->contact) }}"
                            required />
                    </div>

                    <!-- Email -->
                    <div class="mb-4 col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input
                            type="email"
                            placeholder="Type email address"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ old('email', $staffMember->email) }}"
                            required />
                    </div>

                    <!-- Address -->
                    <div class="mb-4 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <textarea
                            placeholder="Type address here"
                            class="form-control"
                            id="address"
                            name="address">{{ old('address', $staffMember->address) }}</textarea>
                    </div>

                    <!-- Date Hired -->
                    <div class="mb-4 col-md-6">
                        <label for="date_hired" class="form-label">Date Hired <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control"
                            id="date_hired"
                            name="date_hired"
                            value="{{ old('date_hired', $staffMember->date_hired) }}"
                            required />
                    </div>

                    <!-- Shift Details -->
                    <div class="mb-4 col-md-6">
                        <label for="shift_details" class="form-label">Shift Details <span class="text-danger">*</span></label>
                        <textarea
                            placeholder="Type details here"
                            class="form-control"
                            id="shift_details"
                            name="shift_details"
                            required>{{ old('shift_details', $staffMember->shift_details) }}</textarea>
                    </div>

                    <!-- Notes -->
                    <div class="mb-4 col-md-6">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea
                            placeholder="Type notes here"
                            class="form-control"
                            id="notes"
                            name="notes">{{ old('notes', $staffMember->notes) }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-4 col-md-6">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1" {{ $staffMember->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $staffMember->status == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>
                    </div>

                    <!-- Update Button -->
                    <div class="d-grid col-md-6">
                        <button type="submit" class="btn btn-primary">Update Staff Member</button>
                    </div>
                </form>

            </div>
        </div>
    </section>


</body>

</html>
@endsection