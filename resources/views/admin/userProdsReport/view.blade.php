@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')

        @if (session('success') === 'Seller has been warned.')
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                Warning message sent!
            </div>
        @endif

        @if (session('success') === 'Seller has been suspended.')
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                Suspend message sent!
            </div>
        @endif

        @if (session('success') === 'Seller has been banned.')
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                Ban message sent!
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead class="table-primary text-dark">
                    <tr class="align-middle">
                        <th scope="col">Reported By</th>
                        <th scope="col">Product</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Custom Message</th>
                        <th scope="col">Image</th>
                        <th scope="col">Reported On</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        @php
                            $product = $report->product;
                            $seller = $product->user ?? null;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $report->user->name ?? 'Unknown User' }}</strong>
                            </td>

                            <td class="text-truncate" style="max-width: 180px;">
                                {{ $product->title ?? 'Deleted Product' }}
                            </td>

                            <td>
                                @if($seller)
                                    <div class="fw-semibold">{{ $seller->name }}</div>
                                    <div class="text-muted small">ID: {{ $seller->id }}</div>
                                @else
                                    <span class="text-muted">Unknown Seller</span>
                                @endif
                            </td>

                            <td>
                                <span class="badge bg-danger text-white px-3 py-2">{{ $report->reason }}</span>
                            </td>

                            <td>
                                @if($report->reason === 'Other')
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#messageModal{{ $report->id }}">
                                        view comment
                                    </button>

                                    <div class="modal fade" id="messageModal{{ $report->id }}" tabindex="-1"
                                        aria-labelledby="messageModal{{ $report->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-3">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Custom Report Message</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-0">{{ $report->custom_reason ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                @if($product && $product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                        class="img-thumbnail zoomable-image"
                                        style="width: 90px; height: 60px; object-fit: cover; cursor: zoom-in;" data-bs-toggle="modal"
                                        data-bs-target="#zoomImageModal" data-image="{{ asset('storage/' . $product->image) }}">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            {{-- ✅ Fixed this line --}}
                            <td>{{ $report->created_at->format('M d, Y h:i A') }}</td>

                            <td class="text-center">
                                @if($seller)
                                    <div class="d-flex flex-column gap-1">
                                        <form action="{{ route('admin.warning', $seller->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-warning w-100" title="Warn this seller"
                                                onclick="return confirm('Are you sure you want to warn this seller?')">
                                                <i class="fas fa-exclamation-circle me-1"></i> Warn
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.suspend', $seller->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-secondary w-100" title="Temporarily suspend seller"
                                                onclick="return confirm('Suspend this seller?')">
                                                <i class="fas fa-user-slash me-1"></i> Suspend
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.ban', $seller->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger w-100" title="Permanently ban seller"
                                                onclick="return confirm('Are you sure you want to ban this seller permanently?')">
                                                <i class="fas fa-ban me-1"></i> Ban
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <!-- Image Zoom Modal -->
                <div class="modal fade" id="zoomImageModal" tabindex="-1" aria-labelledby="zoomImageModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-3 shadow">
                            <div class="modal-header">
                                <h5 class="modal-title" id="zoomImageModalLabel">Zoomed Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="zoomedImage" src="" alt="Zoomed Product" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </table>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const zoomModal = document.getElementById('zoomImageModal');
                const zoomedImage = document.getElementById('zoomedImage');

                document.querySelectorAll('.zoomable-image').forEach(img => {
                    img.addEventListener('click', function () {
                        const imageUrl = this.getAttribute('data-image');
                        zoomedImage.src = imageUrl;
                    });
                });
            });
        </script>


    @endsection
@endcan