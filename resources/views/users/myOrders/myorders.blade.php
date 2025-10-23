@extends('layouts.Users.Homeapp')

@section('content')

    <div class="bg-light">
        <div class="max-w-5xl mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">My reserved products</h2>

            @forelse ($orders as $order)
                @if ($order->product) {{-- ✅ Check if product exists --}}
                    <div class="bg-white rounded-xl shadow-md mb-6 p-4 sm:flex sm:gap-5 sm:items-start">
                        <!-- Product Image -->
                        <div class="w-full sm:w-28 h-28 mb-3 sm:mb-0 flex-shrink-0">
                            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->title }}"
                                class="w-full h-full object-cover rounded-lg border">
                        </div>

                        <!-- Order Info -->
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <h3 class="text-sm font-semibold text-gray-800">{{ $order->product->title }}</h3>
                            </div>

                            <p class="text-sm text-gray-700 mt-3">
                                <span class="font-medium">Quantity:</span> {{ $order->quantity }}
                                kilo{{ $order->quantity > 1 ? 's' : '' }}
                            </p>

                            <p class="text-sm text-gray-700">
                                <span class="font-medium">Total Price:</span>
                                ₱{{ number_format($order->total_price, 2) }}
                            </p>

                            <span class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y g:i A') }}</span>
                        </div>

                        <!-- Buyer Actions -->
                        <div class="flex items-center gap-2">
                            @if ($order->status === 'active')
                                <!-- Mark as Received -->
                                <form method="POST" action="{{ route('users.orders.markReceived', $order->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded shadow-sm"
                                        onclick="return confirm('Confirm you have received this order?');">
                                        Mark as Received
                                    </button>
                                </form>

                                <!-- Cancel Order -->
                                <form method="POST" action="{{ route('users.orders.cancel', $order->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="bg-danger hover:bg-red-600 text-white text-sm px-4 py-2 rounded shadow-sm"
                                        onclick="return confirm('Are you sure you want to cancel this order?');">
                                        Cancel Order
                                    </button>
                                </form>
                            @elseif ($order->status === 'received')
                                <button type="button"
                                    class="bg-indigo-500 text-success text-sm px-4 py-2 rounded shadow-sm cursor-default">
                                    Received
                                </button>
                            @elseif ($order->status === 'completed')
                                <button type="button"
                                    class="bg-gray-400 text-success text-sm px-4 py-2 rounded shadow-sm cursor-not-allowed" disabled>
                                    Completed
                                </button>
                            @elseif ($order->status === 'cancelled')
                                <button type="button"
                                    class="bg-blue-500 text-white text-sm px-4 py-2 rounded shadow-sm cursor-not-allowed" disabled>
                                    Cancelled
                                </button>
                            @endif
                        </div>



                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-md mb-6 p-4 text-red-500">
                        ⚠️ This order refers to a deleted or missing product.
                    </div>
                @endif
            @empty
                <div class="text-center text-gray-500 mt-10">
                    <p class="text-lg">You haven't ordered anything yet.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection