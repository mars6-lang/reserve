<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\SearchLog;
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

    public function searchIndex(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            SearchLog::create([
                'keyword' => $keyword,
                'user_id' => auth()->id(),
            ]);
        }

        $results = products::where('title', 'like', "%{$keyword}%")->get();

        // Get popular searches (top 5 most searched)
        $popularSearches = SearchLog::select('keyword')
            ->groupBy('keyword')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->pluck('keyword');

        return view('users.searchView.index', compact('results', 'popularSearches'));
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

        $searchresults = DB::table('products')
            ->select('*')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return view('users.products.searchresults', compact('searchresults'));
    }

}