<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\MarketAnalysis;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use Illuminate\Support\Str;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('users.dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.dashboard.marketCreate');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function register(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        do {
            $generatedSellerId = 'SELLER-' . strtoupper(Str::random(8));
        } while (Seller::where('seller_id', $generatedSellerId)->exists());

        // Create seller record
        Seller::create([
            'user_id' => Auth::id(),
            'store_name' => $validated['store_name'],
            'seller_id' => $generatedSellerId,
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // Update user to mark as seller
        $user = Auth::user();
        $user->is_seller = true;
        $user->save();

        return redirect('/seller/dashboard')->with('success', 'You are now registered as a seller!');
    }






    public function registeraccount()
    {
        return view('users.registeraccount.index');
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
        MarketAnalysis::destroy($id);
        return redirect()->route('users.dashboard.index')->with('success', 'Entry deleted.');
    }


}
