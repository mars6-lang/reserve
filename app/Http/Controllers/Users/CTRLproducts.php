<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Users\products;
use DB;

class CTRLproducts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $allproducts = products::paginate(10);

        return view('users.products.index')
            ->with('allproducts', $allproducts);



    }

    public function addproduct(Request $request)
    {
        $new = new products();
        $new->title = $request->input('title');
        $new->description = $request->input('desc');
        $new->image = $request->input('img');
        $new->category = $request->input('category');
        $new->quantity = $request->input('quantity');
        $new->price = $request->input('price');
        $new->save();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function prodsDetails($id)
    {
        $prods = products::find($id); // Make sure you import the Product model

        return view('users.prodsDetails.index', compact('product'));
    }


    public function searchresults()
    {
        
    }




    // my search function goes here 
    public function searchproducts(Request $request)
    {
        $keyword = $request->input('keyword');
        $category = $request->input('category'); // This is the selected category from the dropdown

        $searchresults = DB::table('products')
            ->select('*')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->get();

        $categories = DB::table('products')->distinct()->pluck('category');
      

        return view('users.products.searchresults', [
            'searchresults' => $searchresults,
            'categories' => $categories,
        ]);
    }
}