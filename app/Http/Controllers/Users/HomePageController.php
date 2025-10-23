<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\products;
use App\Models\Users\orders;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Main product list
        $allproducts = products::paginate(12); // show 12 per page

        // Recommended for You
        $recommendedProducts = collect();

        if (Auth::check()) {
            $user = Auth::user();

            // If the user has past orders, recommend based on purchased products
            $orderedProductIds = orders::where('user_id', $user->id)
                ->pluck('product_id');

            if ($orderedProductIds->isNotEmpty()) {
                $recommendedProducts = products::whereIn('id', $orderedProductIds)
                    ->inRandomOrder()
                    ->take(8)
                    ->get();
            } else {
                // If no orders yet, show most viewed products
                $recommendedProducts = products::orderBy('views', 'desc')
                    ->take(8)
                    ->get();
            }
        } else {
            // Guests → show random products
            $recommendedProducts = products::inRandomOrder()
                ->take(8)
                ->get();
        }

        return view('users.HomePage', compact('allproducts', 'recommendedProducts'));
    }

    public function about()
    {
        return view('users.appinfo.about');
    }
}
