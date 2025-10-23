<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\reportprods;
use Illuminate\Http\Request;
use App\Models\Users\products;

use App\Models\Users\orders;
use Auth;
class prodsDetailsCRTL extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $product = products::with(['reviews.user', 'reviews.replies.user'])->findOrFail($id);
        return view('users.prodsDetails', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myOrders()
    {
        $orders = orders::with('product')
            ->where('user_id', auth()->id())
            ->whereHas('product') // only fetch orders with valid product
            ->latest()
            ->get();

        return view('users.myOrders.myOrders', compact('orders'));
    }

    /**
     * Track all reservations with status summary
     */
    public function trackReservations(Request $request)
    {
        $status = $request->get('status', null);
        
        $query = orders::with('product', 'seller')
            ->where('user_id', auth()->id())
            ->whereHas('product');

        // If no specific status filter, exclude completed and cancelled
        if ($status) {
            $query->where('status', $status);
        } else {
            $query->whereNotIn('status', ['completed', 'cancelled']);
        }

        $orders = $query->latest()->get();

        // Get status summary
        $summary = orders::where('user_id', auth()->id())
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('users.myOrders.trackReservations', compact('orders', 'summary', 'status'));
    }



    public function ProdsReport($id)
    {
        $product = products::findOrFail($id);
        return view('users.ProdsReport.createReport', compact('product'));
    }
    /**
     * Store a newly created resource in storage.
     */

    public function reportstore(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'reason' => 'required|string|max:500',
            'custom_reason' => 'nullable|string|max:1000', // optional custom reason
            'product_id' => 'required|exists:products,id',
        ]);

        // Save report
        reportprods::create([
            'product_id' => $id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'custom_reason' => $request->custom_reason, // include this field
        ]);

        return redirect()->back()->with('success', 'Report submitted.');
    }

    /**
     * Display the specified resource.
     */

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
}
