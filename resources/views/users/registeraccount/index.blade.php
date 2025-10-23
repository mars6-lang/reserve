@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

    <style>
        body { background: #f8f9fa; }
        
        .seller-header {
            background: linear-gradient(135deg, #069c88 0%, #056659 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 40px;
        }

        .seller-header h1 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .seller-header p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.95;
        }

        .registration-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px 80px;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-bottom: 30px;
        }

        .form-section-title {
            font-size: 1.3rem;
            color: #056659;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid #069c88;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .form-label .required {
            color: #e74c3c;
            margin-left: 4px;
        }

        .form-control, .form-select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus, .form-select:focus, textarea:focus {
            border-color: #069c88;
            outline: none;
            box-shadow: 0 0 0 3px rgba(6, 156, 136, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-hint {
            display: block;
            font-size: 0.85rem;
            color: #666;
            margin-top: 6px;
        }

        .file-input-wrapper {
            position: relative;
            display: block;
        }

        .file-input-wrapper input[type="file"] {
            padding: 40px 15px;
            border: 2px dashed #069c88;
            border-radius: 8px;
            background: #f0fffe;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-wrapper input[type="file"]:hover {
            background: #e8fffe;
            border-color: #056659;
        }

        .form-check {
            display: flex;
            align-items: flex-start;
            margin: 20px 0;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 3px solid #069c88;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            margin-top: 2px;
            margin-right: 12px;
            cursor: pointer;
            accent-color: #069c88;
            flex-shrink: 0;
        }

        .form-check-label {
            cursor: pointer;
            font-size: 0.9rem;
            color: #555;
            line-height: 1.5;
        }

        .form-check-label a {
            color: #069c88;
            text-decoration: none;
            font-weight: 600;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 14px 30px;
            background: linear-gradient(135deg, #069c88 0%, #056659 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(6, 156, 136, 0.3);
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 156, 136, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .success-message {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 15px;
            color: #155724;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .already-seller {
            text-align: center;
            padding: 60px 20px;
        }

        .already-seller-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .already-seller h3 {
            color: #056659;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .already-seller p {
            color: #666;
            font-size: 1rem;
            margin-bottom: 25px;
        }

        .btn-dashboard {
            display: inline-block;
            padding: 12px 30px;
            background: #069c88;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-dashboard:hover {
            background: #056659;
            transform: translateY(-2px);
        }

        .info-box {
            background: #e8f5f3;
            border-left: 4px solid #069c88;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .info-box strong {
            color: #056659;
        }

        /* Validation Alerts */
        .validation-errors {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #e74c3c;
        }

        .validation-errors h4 {
            color: #c0392b;
            margin: 0 0 12px 0;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .validation-errors ul {
            margin: 0;
            padding-left: 25px;
            list-style: disc;
        }

        .validation-errors li {
            color: #a93226;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .validation-errors li:last-child {
            margin-bottom: 0;
        }

        /* Field-level error styling */
        .form-control.is-invalid,
        .form-select.is-invalid,
        textarea.is-invalid {
            border-color: #e74c3c;
            background-color: #fef5f5;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus,
        textarea.is-invalid:focus {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .field-error {
            display: block;
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 6px;
            font-weight: 500;
        }

        .field-error::before {
            content: "⚠ ";
            margin-right: 4px;
        }

        @media (max-width: 768px) {
            .seller-header h1 {
                font-size: 1.8rem;
            }

            .form-card {
                padding: 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Header -->
    <div class="seller-header">
        <div class="container">
            <h1>Become a Verified Seller</h1>
            <p>Join our trusted seller community and start showcasing your products to thousands of potential buyers. 
            Verified sellers gain exclusive access to selling tools, promotions, and marketplace visibility.</p>
        </div>
    </div>

    <!-- Content -->
    <div class="registration-container">

        @if (session('status') === 'Your seller application has been submitted for review.')
            <div class="success-message">
                ✓ Your seller application has been submitted for review. We'll notify you within 24-48 hours.
            </div>
        @endif

        @if (!auth()->user()->is_seller)
            <!-- Registration Form -->
            <div class="form-card">
                <div class="info-box">
                    <i class="fas fa-info-circle"></i> <strong>Tip:</strong> Make sure your documents are clear and valid to avoid delays in approval.
                </div>

                <!-- Validation Errors Alert -->
                @if ($errors->any())
                    <div class="validation-errors">
                        <h4>
                            <span>✕</span>
                            Please fix the following errors:
                        </h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.registeraccount.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Personal Information Section -->
                    <h2 class="form-section-title">Personal Information</h2>

                    <div class="form-group">
                        <label class="form-label" for="full_name">Full Name <span class="required">*</span></label>
                        <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" 
                               placeholder="Enter your full name..." value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="gender">Gender <span class="required">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                <option value="">Select your gender...</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="age">Age <span class="required">*</span></label>
                            <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" 
                                   placeholder="Must be 18+" min="18" value="{{ old('age') }}" required>
                            @error('age')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">Complete Address <span class="required">*</span></label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                  placeholder="House No., Street, City, Province" required>{{ old('address') }}</textarea>
                        <span class="form-hint">Include your complete residential address</span>
                        @error('address')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Store Information Section -->
                    <h2 class="form-section-title">Store / Business Information</h2>

                    <div class="form-group">
                        <label class="form-label" for="store_name">Store / Business Name <span class="required">*</span></label>
                        <input type="text" name="store_name" class="form-control @error('store_name') is-invalid @enderror" 
                               placeholder="Enter your store name..." value="{{ old('store_name') }}" required>
                        @error('store_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number <span class="required">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               placeholder="Enter your contact number (e.g., 09xxxxxxxxx)" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Document Uploads Section -->
                    <h2 class="form-section-title">Verification Documents</h2>
                    <p style="color: #666; margin-bottom: 20px;">Upload clear and valid copies of your business documents. High-quality photos help speed up approval.</p>

                    <div class="form-group">
                        <label class="form-label" for="business_permit">Business Permit <span class="required">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" name="business_permit" accept="image/*,.pdf" class="@error('business_permit') is-invalid @enderror" required>
                        </div>
                        <span class="form-hint">📄 JPG, PNG, PDF (max 5MB). Must be clear and readable.</span>
                        @error('business_permit')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="valid_id">Valid ID / Government-Issued ID <span class="required">*</span></label>
                        <div class="file-input-wrapper">
                            <input type="file" name="valid_id" accept="image/*,.pdf" class="@error('valid_id') is-invalid @enderror" required>
                        </div>
                        <span class="form-hint">📄 JPG, PNG, PDF (max 5MB). Can be National ID, Driver's License, Passport, etc.</span>
                        @error('valid_id')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Terms Agreement -->
                    <div class="form-check @error('terms') is-invalid @enderror">
                        <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                        <label class="form-check-label" for="terms">
                            I confirm that the information provided is true and valid. I agree to the 
                            <a href="#">Seller Terms & Conditions</a> and 
                            <a href="#">Privacy Policy</a>.
                        </label>
                        @error('terms')
                            <span class="field-error" style="display: block; margin-top: 8px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">
                        Submit Seller Application
                    </button>
                </form>
            </div>

        @else
            <!-- Already a Seller Message -->
            <div class="form-card already-seller">
                <div class="already-seller-icon">✓</div>
                <h3>You're Already a Verified Seller!</h3>
                <p>Your seller account is active and ready to go. Access your seller tools and start managing your shop.</p>
                <a href="{{ url('/seller/dashboard') }}" class="btn-dashboard">Go to Seller Dashboard</a>
            </div>
        @endif

    </div>

    @endsection
@endcan