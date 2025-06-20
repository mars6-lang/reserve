@extends('layouts.Users.Homeapp')

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h5>Lists of Products</h5>

                    <form action="{{route('users.searchproducts')}}" method="post" class="col-4 m-4">
                        @csrf
                        @method('GET')

                        <div class="form-group">
                            <input type="text" name="keyword" placeholder="search here..." class="form-control" id=""
                                required>
                            <input type="submit" value="Search" class="m-2 btn btn-primary">
                        </div>
                    </form>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>Product image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>stock</th>
                            <th>price</th>
                        </thead>
                        @foreach($allproducts as $prods)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $prods->image) }}" alt="{{ $prods->title }}"
                                        style="width: 100px; height: auto;">
                                </td>
                                <td>{{$prods->title}}</td>
                                <td>{{$prods->category}}</td>
                                <td>{{$prods->stocks}}</td>
                                <td>{{$prods->price}}</td>
                            </tr>
                        @endforeach
                    </table>

                    {{$allproducts->links()}}

                </div>
            </div>
        </div>
    </div>


@endsection