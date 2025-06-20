@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')



        <div class="container py-5">
            <h4 class="mb-4">
                Showing results
                @if(request()->keyword) for keyword: <strong>"{{ request()->keyword }}"</strong> @endif
                @if(request()->category) in category: <strong>"{{ request()->category }}"</strong> @endif
            </h4>

            @if($searchresults->isEmpty())
                <div class="alert alert-warning text-center">No products found matching your criteria.</div>
            @else
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($searchresults as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                    class="card-img-top" alt="{{ $product->title }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-bold">{{ $product->title }}</h5>
                                    <p class="text-muted mb-2">Category: {{ ucfirst($product->category) }}</p>
                                    <p>₱{{ number_format($product->price, 2) }} / kilo</p>
                                    <p class="small">{{ Str::limit($product->description, 80, '...') }}</p>
                                    <a href="{{ route('users.prodsDetails', $product->id) }}" class="btn btn-primary mt-auto w-100">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endsection
@endcan