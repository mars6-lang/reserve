@extends('layouts.Users.Homeapp')

@section('content')
    <div class="max-w-md mx-auto p-4 mt-6">

        <!-- Search Form -->
        <form action="{{ route('users.searchproducts') }}" method="GET" class="flex gap-2">
            <input type="text" name="keyword" placeholder="Search products..."
                class="flex-1 py-2 px-3 border rounded-full text-sm" autofocus value="{{ request()->keyword }}">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm">
                Go
            </button>
        </form>

        <!-- Recent Searches -->
        @if(session('recent_searches'))
            <div class="mt-4">
                <h2 class="text-gray-600 font-medium mb-2">Recent Searches</h2>
                <ul class="space-y-1">
                    @foreach(session('recent_searches') as $recent)
                        <li>
                            <a href="{{ route('users.searchproducts', ['keyword' => $recent]) }}"
                                class="text-blue-600 hover:underline text-sm">
                                {{ $recent }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Most Popular Searches -->
        @if(isset($popularSearches) && count($popularSearches) > 0)
            <div class="mt-6">
                <h2 class="text-gray-600 font-medium mb-2">Most Popular Searches</h2>
                <ul class="flex flex-wrap gap-2">
                    @foreach($popularSearches as $keyword)
                        <li>
                            <a href="{{ route('users.searchproducts', ['keyword' => $keyword]) }}"
                                class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm hover:bg-gray-300">
                                {{ $keyword }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Search Results -->
        @isset($results)
            <div class="mt-6">
                <h2 class="text-gray-800 font-medium mb-2">Search Results</h2>
                @if(count($results) > 0)
                    <ul class="space-y-3">
                        @foreach($results as $product)
                            <li class="border p-2 rounded flex justify-between items-center">
                                <span>{{ $product->title }}</span> <!-- ✅ changed from name -->
                                <span class="text-gray-500 text-sm">₱{{ number_format($product->price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">No results found.</p>
                @endif
            </div>
        @endisset

    </div>
@endsection