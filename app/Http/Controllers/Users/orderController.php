<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\orders;
use App\Models\Users\products;
use App\Notifications\ReservedOrdersNotification;
use Auth;
class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.orders.index');
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
    public function prodsDetailsStore(Request $request)
    {
        $product = products::findOrFail($request->product_id);

        $request->validate([
            'quantity' => 'nullable|numeric|min:0',
            'custom_price' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:gcash,cod',
        ]);

        $quantityInput = $request->input('quantity');
        $customInput = $request->input('custom_price');

        $isCustom = $customInput > 0;
        $quantity = $isCustom ? 0 : ($quantityInput ?? 0);
        $customPrice = $isCustom ? $customInput : 0;

        $discountedPrice = $product->discount_percent
            ? $product->price * (1 - $product->discount_percent / 100)
            : $product->price;

        $totalPrice = $isCustom
            ? $customPrice
            : $discountedPrice * $quantity;

        // Create order
        $order = orders::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'custom_price' => $customPrice,
            'user_id' => auth()->id(),
            'seller_id' => $product->user_id,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'status' => 'active',
        ]);

        // 🔔 Notify the seller
        $seller = $product->user; // or User::find($product->user_id)
        $buyer = auth()->user();

        $seller->notify(new ReservedOrdersNotification(
            $buyer->name,
            $product->name,
            $product->image ?? null
        ));

        return redirect()->back()->with('success', 'Product reserved successfully!');
    }


    // Seller views all orders for their products
    public function selleroders()
    {
        $sellerId = Auth::id(); // logged-in seller
        $orders = orders::whereHas('product', function ($query) use ($sellerId) {
            $query->where('user_id', $sellerId); // assuming products table has a user_id for seller
        })->with(['product', 'user'])->latest()->get();

        return view('seller.orders.index', compact('orders'));
    }




    public function cancel(orders $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->status = 'cancelled';
        $order->save();

        return back()->with('status', 'Order cancelled successfully.');
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
}
