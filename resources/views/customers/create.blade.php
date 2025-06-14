@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark mb-0">Add New Customer</h2>
            <a href="{{ route('customers.index') }}" class="btn btn-outline-dark d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                Back to Customer List
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('customers.store') }}" method="POST" id="customerForm">
                @csrf

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Save Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        $('#customerForm').on('submit', function(event) {
            let isValid = true;

            if (!$('#first_name').val().trim()) {
                $('#first_name').addClass('is-invalid');
                isValid = false;
            } else {
                $('#first_name').removeClass('is-invalid');
            }

            
            if (!$('#last_name').val().trim()) {
                $('#last_name').addClass('is-invalid');
                isValid = false;
            } else {
                $('#last_name').removeClass('is-invalid');
            }

           
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!$('#email').val().trim() || !emailRegex.test($('#email').val().trim())) {
                $('#email').addClass('is-invalid');
                isValid = false;
            } else {
                $('#email').removeClass('is-invalid');
            }

      
            if (!$('#phone').val().trim()) {
                $('#phone').addClass('is-invalid');
                isValid = false;
            } else {
                $('#phone').removeClass('is-invalid');
            }

        
            if (!$('#address').val().trim()) {
                $('#address').addClass('is-invalid');
                isValid = false;
            } else {
                $('#address').removeClass('is-invalid');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush
@endsection
