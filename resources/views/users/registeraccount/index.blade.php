@can('user-access')

    @extends('layouts.Users.Homeapp')

    @section('content')
        <div class="container my-5">

            @if (!auth()->user()->is_seller)
                <!-- Seller Registration Form -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Become a Seller</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('users/register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="store_name" class="form-label">Store Name / Seller Name</label>
                                <input type="text" name="store_name"
                                    class="form-control focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm focus:shadow-lg transition"
                                    placeholder="Enter your store or seller name..." required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label ">Phone Number <small
                                        class="text-muted">(optional)</small></label>
                                <input type="text" name="phone"
                                    class="form-control focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm focus:shadow-lg transition"
                                    placeholder="Enter your contact number...">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Store Address <small
                                        class="text-muted">(optional)</small></label>
                                <textarea name="address"
                                    class="form-control focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm focus:shadow-lg transition"
                                    rows="3" placeholder="Enter the address of your store..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-info text-white">Submit Application</button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Already a Seller  -->
                <div class="alert alert-info text-center mt-4">
                    <h5 class="mb-2">You're already registered as a seller!</h5>
                    <p class="mb-3">Access your seller tools and start managing your shop.</p>
                    <a href="{{ url('/seller/dashboard') }}" class="btn btn-outline-secondary">Go to Seller Dashboard</a>
                </div>
            @endif

        </div>


    @endsection
@endcan