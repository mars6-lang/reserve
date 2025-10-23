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
        $sort = $request->get('sort', 'newest'); // default sorting

        // Base query (no category, carousel, or random products)
        $query = products::with('user', 'reviews')
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });

        // Sorting logic
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Fetch all products
        $allproducts = $query->get();

        // Group products by seller
        $productsBySeller = $allproducts
            ->groupBy(fn($product) => $product->user ? $product->user->id : 'unknown')
            ->map(function ($group) {
                $seller = $group->first()->user;
                return (object) [
                    'id' => $seller?->id,
                    'name' => $seller?->name ?? 'Unknown Seller',
                    'products' => $group,
                ];
            })
            ->values();

        // ✅ Return clean data (only what’s actually used)
        return view('users.Market', compact('allproducts', 'productsBySeller', 'sort'));
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
        // Check if this user has at least one received/completed order for this product
        if (
            !$product->orders()
                ->where('user_id', auth()->id())
                ->whereIn('status', ['received', 'completed'])
                ->exists()
        ) {
            return back()->with('error', 'You can only review after receiving the product.');
        }

        // Validate review input
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Create review
        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }






    public function bestSellers()
    {
        $bestSellers = Products::leftJoin('orders', 'orders.product_id', '=', 'products.id')
            ->select('products.*', \DB::raw('COALESCE(SUM(orders.quantity), 0) as total_sold'))
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->take(10)
            ->get();

        return view('users.products.bestSellers', compact('bestSellers'));
    }

    public function poorSellers()
    {
        $poorSellers = Products::leftJoin('orders', 'orders.product_id', '=', 'products.id')
            ->leftJoin('reviewcomments', 'reviewcomments.product_id', '=', 'products.id')
            ->select(
                'products.*',
                \DB::raw('COALESCE(SUM(orders.quantity), 0) as total_sold'),
                \DB::raw('COALESCE(AVG(reviewcomments.rating), 0) as avg_rating')
            )
            ->groupBy('products.id')
            ->having('total_sold', '<', 10) // less than 10 sold
            ->orderBy('avg_rating', 'desc')
            ->take(10)
            ->get();

        return view('users.products.poorSellers', compact('poorSellers'));
    }

    public function Catindex(Request $request)
    {
        // Get category from request
        $category = $request->input('category');

        // Optional: filter by search keyword
        $keyword = $request->input('keyword');

        $productsQuery = products::query();

        if ($category) {
            $productsQuery->where('category', $category);
        }

        if ($keyword) {
            $productsQuery->where('title', 'like', '%' . $keyword . '%');
        }

        // Example: sort by newest first
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'price_low_high':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $productsQuery->orderBy('created_at', 'desc');
        }

        $products = $productsQuery->paginate(12); // adjust per page

        return view('users.ShopCategory.Catindex', [
            'products' => $products,
            'category' => $category,
            'sort' => $sort,
        ]);
    }
}



