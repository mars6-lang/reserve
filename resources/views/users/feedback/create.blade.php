@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-8">

                    <h3 class="text-2xl font-bold mb-6 text-gray-800">
                        Share Your Feedback
                    </h3>

                    <!-- flashed success message -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('users.feedback.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('POST')

                        <!-- Email (readonly) -->
                        <div class="mb-4">
                            <label class="form-label font-semibold">Your Email</label>
                            <input type="text" name="email" value="{{ Auth::user()->email }}" readonly
                                class="form-control bg-light" required>
                            <div class="invalid-feedback">Email is required.</div>
                        </div>

                        <!-- Star Rating -->
                        <div class="mb-4">
                            <label class="form-label font-semibold">Your Rating</label>
                            <div class="star-rating d-flex flex-row-reverse justify-content-start">
                                <input type="radio" id="star5" name="rate" value="5" required /><label for="star5"
                                    title="Outstanding">★</label>
                                <input type="radio" id="star4" name="rate" value="4" /><label for="star4"
                                    title="Very Good">★</label>
                                <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="Good">★</label>
                                <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="Fair">★</label>
                                <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="Poor">★</label>
                            </div>
                            <div class="invalid-feedback">Please select a rating.</div>
                        </div>

                        <!-- Comments -->
                        <div class="mb-4">
                            <label class="form-label font-semibold">Your Feedback</label>
                            <textarea name="comm" rows="4" class="form-control" placeholder="Write your feedback here..."
                                required></textarea>
                            <div class="invalid-feedback">Please enter your comments.</div>
                        </div>

                        <!-- Submit -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                Submit Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Star Rating CSS -->
        <style>
            .star-rating {
                direction: rtl;
                font-size: 2rem;
            }

            .star-rating input {
                display: none;
            }

            .star-rating label {
                color: #ccc;
                cursor: pointer;
                transition: color 0.2s;
            }

            .star-rating input:checked~label {
                color: #f5c518;
            }

            .star-rating label:hover,
            .star-rating label:hover~label {
                color: #f5c518;
            }
        </style>

    @endsection
@endcan