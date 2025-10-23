@extends('layouts.Users.Homeapp')

@section('content')

    <div class="bg-light">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">📦 Track Your Reservations</h2>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-6">
                <form method="GET" action="{{ route('users.reservations.track') }}" class="flex items-center gap-4">
                    <label class="text-gray-700 font-medium">Filter by Status:</label>
                    <select name="status" class="form-select border-gray-300 rounded" onchange="this.form.submit()">
                        <option value="">All Reservations</option>
                        <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="received" {{ $status === 'received' ? 'selected' : '' }}>Received</option>
                        <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
            </div>

            <!-- Reservations List -->
            @forelse ($orders as $order)
                @if ($order->product)
                    <div class="bg-white rounded-lg shadow-md mb-4 p-5 hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row gap-5">
                            <!-- Product Image -->
                            <div class="md:w-24 h-24 flex-shrink-0">
                                <img src="{{ asset('storage/' . $order->product->image) }}" 
                                    alt="{{ $order->product->title }}"
                                    class="w-full h-full object-cover rounded-lg border">
                            </div>

                            <!-- Reservation Details -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">{{ $order->product->title }}</h3>
                                        <p class="text-sm text-gray-600">Seller: <strong>{{ $order->seller->name ?? 'Unknown' }}</strong></p>
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    <span class="px-4 py-2 rounded-full text-white text-sm font-semibold
                                        @if($order->status === 'active') bg-yellow-500
                                        @elseif($order->status === 'received') bg-blue-500
                                        @elseif($order->status === 'completed') bg-green-500
                                        @elseif($order->status === 'cancelled') bg-red-500
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Quantity</p>
                                        <p class="font-semibold text-gray-800">{{ $order->quantity }} kg</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Unit Price</p>
                                        <p class="font-semibold text-gray-800">₱{{ number_format($order->product->price, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Total Price</p>
                                        <p class="font-bold text-green-600 text-lg">₱{{ number_format($order->total_price, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Reserved On</p>
                                        <p class="font-semibold text-gray-800">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>

                                <!-- Timeline Info -->
                                <div class="text-xs text-gray-500 mb-3">
                                    <p>📅 Reserved: {{ $order->created_at->format('M d, Y g:i A') }}</p>
                                </div>

                                <!-- Actions -->
                                @if($order->status === 'active')
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('users.orders.markReceived', $order->id) }}" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded transition"
                                                onclick="return confirm('Mark as received?');">
                                                ✓ Mark as Received
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('users.orders.cancel', $order->id) }}" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded transition"
                                                onclick="return confirm('Cancel this reservation?');">
                                                ✗ Cancel
                                            </button>
                                        </form>
                                    </div>
                                @elseif($order->status === 'received')
                                    <p class="text-sm text-blue-600 font-semibold">✓ Received - Ready for review</p>
                                @elseif($order->status === 'completed')
                                    <p class="text-sm text-green-600 font-semibold">✓ Completed</p>
                                @elseif($order->status === 'cancelled')
                                    <p class="text-sm text-red-600 font-semibold">✗ Cancelled on {{ $order->updated_at->format('M d, Y') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-gray-500 text-lg mb-4">📭 No reservations found</p>
                    <a href="{{ route('users.Market.index') }}" class="text-blue-600 hover:underline font-semibold">
                        Browse products to make a reservation
                    </a>
                </div>
            @endforelse

        </div>
    </div>

@endsection
