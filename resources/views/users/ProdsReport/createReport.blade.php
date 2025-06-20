@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

        <div class="container py-5">

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="alert alert-success text-center text-green-600 text-lg">
                {{ session('success') }}
            </div>
        @endif

        
            <div class="card shadow-sm rounded-4">
                <div class="card-body">

                    <h3 class="mb-4 fw-bold text-danger">Report Product: <span class="text-dark">{{ $product->title }}</span>
                    </h3>

                    @if($product->image)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                class="img-fluid rounded" style="max-height: 300px;">
                        </div>
                    @endif


                    <form action="{{ route('users.ProdsReport', ['id' => $product->id]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Report Reason Dropdown -->
                        <div class="form-group mb-3">
                            <label for="reason" class="form-label fw-semibold">Select reason report about this:</label>
                            <select name="reason" id="reason" class="form-select shadow-sm" required
                                onchange="toggleCustomReason(this)">
                                <option value="">-- Select a reason --</option>
                                <option value="Fish appears rotten or spoiled">Fish appears rotten or spoiled</option>
                                <option value="Mold or strange odor in product">Mold or strange odor in product</option>
                                <option value="Not fresh as advertised">Not fresh as advertised</option>
                                <option value="Wrong species or mislabeled fish">Wrong species or mislabeled fish</option>
                                <option value="Visible damage or contamination">Visible damage or contamination</option>
                                <option value="Unhygienic packaging or handling">Unhygienic packaging or handling</option>
                                <option value="Suspicion of unsafe for consumption">Suspicion of unsafe for consumption</option>
                                <option value="Other">Other (please specify below)</option>
                            </select>
                        </div>


                        <div class="form-group mb-3" id="customReasonWrapper" style="display: none;">
                            <label for="custom_reason" class="form-label">Additional Details:</label>
                            <textarea name="custom_reason" id="custom_reason" class="form-control shadow-sm" rows="4"
                                placeholder="Describe your concern..."></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <button type="submit" class="btn btn-outline-danger w-100">Submit Report</button>
                            <a href="{{ route('users.Market.index') }}" class="btn btn-outline-secondary w-100">Back to
                                Products</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Script to show/hide custom reason -->
        <script>
            function toggleCustomReason(select) {
                const customField = document.getElementById('customReasonWrapper');
                if (select.value === 'Other') {
                    customField.style.display = 'block';
                } else {
                    customField.style.display = 'none';
                }
            }
        </script>
    @endsection
@endcan