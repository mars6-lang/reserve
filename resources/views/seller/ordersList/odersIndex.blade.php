@extends('layouts.Users.Homeapp')
@section('content')




    <div class="bg-light p-3 p-md-5 rounded">
        <div class="max-w-5xl mx-auto px-4 py-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Orders List for Buyers</h2>

            @php
                $shownActiveProductIds = [];
            @endphp

            @forelse ($orders as $order)

                @if (
                        $order->status === 'active' &&
                        in_array($order->product_id, $shownActiveProductIds)
                    )
                    @continue
                @endif

                @if ($order->status === 'active')
                    @php
                        $shownActiveProductIds[] = $order->product_id;
                    @endphp
                @endif

                @if ($order->status === 'active')
                    <!-- Mark as Received -->
                    <form action="{{ route('seller.seller.markReceived', $order->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Confirm order received?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-4 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                            Mark as Received
                        </button>
                    </form>
                @elseif ($order->status === 'received')
                    <!-- Already Received (show as blue-gray to indicate success) -->
                    <button class="px-4 py-1 bg-indigo-500 text-success text-sm rounded cursor-default">
                        Received
                    </button>

                    <!-- Still allow seller to mark as Completed -->
                    <form action="{{ route('seller.seller.markCompleted', $order->id) }}" method="POST" class="inline-block ml-2"
                        onsubmit="return confirm('Confirm order completed?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-4 py-1 bg-green-500 text-success text-sm rounded hover:bg-green-600 transition-colors">
                            Mark as Completed
                        </button>
                    </form>
                @elseif ($order->status === 'completed')
                    <!-- Final Completed state -->
                    <button class="px-4 py-1 bg-gray-400 text-success text-sm rounded cursor-not-allowed" disabled>
                        Completed
                    </button>
                @endif




                <div class="bg-white rounded-xl mb-6 p-4 sm:flex sm:gap-5 sm:items-start">
                    <!-- Product Image -->
                    <div class="w-full sm:w-28 h-28 mb-3 sm:mb-0 flex-shrink-0">
                        <img src="{{ $order->product->image ? asset('storage/' . $order->product->image) : 'https://via.placeholder.com/100' }}"
                            alt="{{ $order->product->title }}" class="w-full h-full object-cover rounded-lg border">
                    </div>

                    <!-- Order Info -->
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $order->product->title }}
                            </h3>
                            <span class="text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y g:i A') }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-700">
                            <span class="font-medium">Buyer:</span> {{ $order->user->name }}
                        </p>

                        @if($order->quantity)
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">Quantity:</span>
                                {{ $order->quantity }} kilo{{ $order->quantity > 1 ? 's' : '' }}
                            </p>
                        @endif

                        @if ($order->custom_price)
                            <p class="text-sm text-red-600 font-medium">
                                Buyer's Requested Balor/Worth: ₱{{ number_format($order->custom_price, 2) }}
                            </p>
                        @endif

                        <p class="text-sm text-gray-700">
                            <span class="font-medium">Total Price:</span>
                            ₱{{ number_format($order->total_price, 2) }}
                        </p>

                        <p class="text-sm text-gray-700">
                            <span class="font-medium">Payment Method:</span>
                            <span class="inline-block bg-gray-100 text-gray-700 rounded px-2 py-0.5 text-xs capitalize">
                                {{ str_replace('_', ' ', $order->payment_method) }}
                            </span>
                        </p>

                        <div class="text-sm mt-2">
                            <p class="text-xs text-gray-400">Status: {{ $order->status }}</p>

                            @if ($order->isCancelled())
                                <span class="text-red-500 font-semibold">Cancelled by Buyer</span>
                            @elseif ($order->status === 'completed')
                                <span class="text-green-600 font-semibold">Completed</span>
                            @else
                                <span class="text-gray-700">Active</span>
                            @endif


                        </div>
                    </div>
                </div>

            @empty
                <div class="text-center text-gray-500 mt-10">
                    <p class="text-lg">No orders found.</p>
                </div>
            @endforelse
        </div>
    </div>


@endsection