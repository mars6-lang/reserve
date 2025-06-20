<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\products;
use App\Models\Users\reportprods;
use App\Models\Users\MarketMonitoring;

use Auth;
class marketController extends Controller
{

    public function index(Request $request)
    {
        $allproducts = products::with('user')
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('category', 'like', '%' . $request->keyword . '%');
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->get()
            ->groupBy('user_id')
            ->sortByDesc(function ($products) {

                return $products->max('created_at');
            });

        $categories = products::select('category')->distinct()->pluck('category')->filter();

        $allproducts = products::with('user', 'reviews')->get()->groupBy('user_id');
        return view('users.Market', compact('allproducts', 'categories'));
    }


    public function prodsDetails($id)
    {
        $product = products::find($id);

        return view('users.prodsDetails.index', compact('product'));
    }




    public function ProdsReport($id)
    {
        $product = products::findOrFail($id);
        return view('users.ProdsReport.index', compact('product'));

    }




    public function store(Request $request, products $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }



}
