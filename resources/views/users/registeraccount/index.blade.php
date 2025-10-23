@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

        @if (session('status') === 'Your seller application has been submitted for review.')
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                Your seller application has been submitted for review.
            </div>
        @endif
        <div class="container my-5">

            @if (!auth()->user()->is_seller)
                <!-- Seller Registration Introduction -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-success">Become a Verified Seller</h2>
                    <p class="text-muted">
                        Join our trusted seller community and start showcasing your products to thousands of potential buyers.
                        Verified sellers gain exclusive access to selling tools, promotions, and marketplace visibility.
                    </p>
                    <div class="alert alert-info shadow-sm rounded-4">
                        <i class="fas fa-info-circle"></i> <strong>Tip:</strong> Make sure your documents are clear and valid
                        to avoid delays in approval.
                    </div>
                </div>

                <!-- Seller Registration Form -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-success text-white rounded-top-4">
                        <h4 class="mb-0">Seller Verification Form</h4>
                        <small>Please fill out all required fields to verify your seller account.</small>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.registeraccount') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Personal Information -->
                            <h5 class="mb-3 text-success">Personal Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" class="form-control rounded-pill shadow-sm"
                                        placeholder="Enter your full name..." required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select name="gender" class="form-select rounded-pill shadow-sm" required>
                                        <option value="">Select...</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="number" name="age" class="form-control rounded-pill shadow-sm" placeholder="18+"
                                        min="18" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Complete Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control shadow-sm rounded-3" rows="3"
                                    placeholder="House No., Street, City, Province" required></textarea>
                            </div>

                            <!-- Store Information -->
                            <h5 class="mb-3 text-success">Store / Business Information</h5>
                            <div class="mb-3">
                                <label for="store_name" class="form-label">Store / Business Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="store_name" class="form-control rounded-pill shadow-sm"
                                    placeholder="Enter your store name..." required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control rounded-pill shadow-sm"
                                    placeholder="Enter your contact number..." required>
                            </div>

                            <!-- Document Uploads -->
                            <h5 class="mb-3 text-success">Verification Documents</h5>
                            <p class="small text-muted">Upload clear and valid copies of your business documents.</p>

                            <div class="mb-3">
                                <label for="business_permit" class="form-label">Upload Business Permit <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="business_permit" class="form-control shadow-sm" accept="image/*,.pdf"
                                    required>
                                <small class="text-muted">Accepted formats: JPG, PNG, PDF (max 5MB)</small>
                            </div>

                            <div class="mb-3">
                                <label for="valid_id" class="form-label">Upload Valid ID <span class="text-danger">*</span></label>
                                <input type="file" name="valid_id" class="form-control shadow-sm" accept="image/*,.pdf" required>
                                <small class="text-muted">Accepted formats: JPG, PNG, PDF (max 5MB)</small>
                            </div>

                            <!-- Terms -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label small text-muted" for="terms">
                                    I confirm that the information provided is true and valid.
                                    I agree to the <a href="#" class="text-decoration-none">Seller Terms & Conditions</a>.
                                </label>
                            </div>

                            <button type="submit" class="btn btn-success w-100 rounded-pill shadow-sm">
                                Submit Seller Application
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Already a Seller -->
                <div class="alert alert-success text-center mt-4 rounded-4 shadow-sm">
                    <h5 class="mb-2">You're already registered as a seller!</h5>
                    <p class="mb-3">Access your seller tools and start managing your shop.</p>
                    <a href="{{ url('/seller/dashboard') }}" class="btn btn-outline-success rounded-pill">Go to Seller Dashboard</a>
                </div>
            @endif

        </div>
    @endsection
@endcan