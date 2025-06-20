<?php

namespace App\Http\Controllers\Seller;
use App\Models\Users\products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\reviewcomments;
use App\Models\Users\orders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Users\MarketMonitoring;

class SellerController extends Controller
{

    public function index()
    {




        return view('seller.dashboard');

    }


    public function showBuyerChat($buyerId)
    {
        $buyer = User::findOrFail($buyerId); // or use your actual Buyer model if separate
        return view('sellers.chatroom', compact('buyer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function sellerAdd()
    {


        return view('seller.sellerAdd.create')->with('success', 'Product added successfully!');

    }


    public function ManageProds()
    {
        $products = products::where('user_id', Auth::id())->get();
        return view('seller.sellerManageProds.ManageProds', compact('products'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function sellerStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        products::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'price' => $request->price,
            'stocks' => $request->stocks,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $path,
            'discount_percent' => $request->discount_percent,
        ]);

        return redirect()->route('seller.sellerAdd')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function Prodsupdate(Request $request, $id)
    {
        // Find the product by ID
        $product = products::findOrFail($id);

        // Validate inputs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stocks' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // Update the product
        $product->update($validated);

        return redirect()->route('seller.dashboard.index')->with('success', 'Product updated!');
    }


    public function ManageProdsEdit($id)
    {
        $product = products::findOrFail($id);
        return view('seller.sellerManageProds.ManageProdsEdit', compact('product'));
    }



    public function notindex()
    {
        return view('seller.notification.notindex');
    }

    public function notidelete($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }

    public function deleteall()
    {
        $user = Auth::user();

        // Delete all notifications (read and unread)
        $user->notifications()->delete();

        return back()->with('success', 'All notifications deleted.');
    }




    public function productsRatings()
    {
        $seller = auth()->user(); // The currently logged-in seller

        // Fetch all product IDs that belong to the seller
        $productIds = products::where('user_id', $seller->id)->pluck('id');

        // Fetch reviews for those products
        $reviews = reviewcomments::whereIn('product_id', $productIds)
            ->with(['product', 'user']) // eager load product & reviewer
            ->latest()
            ->get();

        return view('seller.productsRatings.show', compact('reviews'));
    }




    public function ordersList()
    {
        $sellerId = Auth::id();
        $status = request('status');

        $orders = orders::whereHas('product', function ($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })
            ->when($status, fn($q) => $q->where('status', $status))
            ->with(['product', 'user'])
            ->latest()
            ->get()
            ->unique(function ($order) {
                return $order->user_id . '-' . $order->product_id;
            });

        return view('seller.ordersList.odersIndex', compact('orders'));

    }


    public function markCompleted(orders $order)
    {
        // Optional: make sure the authenticated seller owns this order
        if ($order->seller_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the order status
        $order->update([
            'status' => 'completed'
        ]);

        // Create a market monitoring log
        MarketMonitoring::create([
            'product_id' => $order->product_id,
            'price' => $order->custom_price > 0 ? $order->custom_price : $order->product->price,
            'custom_price' => $order->custom_price > 0 ? $order->custom_price : null,
            'quantity' => $order->quantity,
            'market_date' => now()




        ]);

        return redirect()->back()->with('success', 'Order marked as completed and added to market data.');
    }





    public function marketanalysis(Request $request)
    {
        $sellerId = auth()->id();

        $products = Products::all(); // dropdown menu
        $productsWithLogs = auth()->user()->products()->has('marketLogs')->get(); // chart display

        $months = collect([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ]);

        $monthlyRaw = DB::table('market_monitoring')
            ->join('products', 'market_monitoring.product_id', '=', 'products.id')
            ->selectRaw("
        MONTHNAME(market_monitoring.market_date) as month,
        SUM(
            CASE
                WHEN market_monitoring.custom_price > 0 THEN market_monitoring.custom_price
                ELSE market_monitoring.price * market_monitoring.quantity
            END
        ) as total
    ")
            ->where('products.user_id', $sellerId)
            ->groupByRaw("MONTHNAME(market_monitoring.market_date)")
            ->get()
            ->pluck('total', 'month');

        // ✅ Format for chart.js
        $monthlyData = $months->map(function ($month) use ($monthlyRaw) {
            return [
                'label' => $month,
                'total' => $monthlyRaw[$month] ?? 0
            ];
        })->toArray();



        // Daily Earnings (last 7 days)
        $daysOfWeek = collect(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);

        $dailyRaw = DB::table('market_monitoring')
            ->join('products', 'market_monitoring.product_id', '=', 'products.id')
            ->selectRaw("
        DAYNAME(market_monitoring.market_date) as dayname,
        SUM(
            CASE
                WHEN market_monitoring.custom_price > 0 THEN market_monitoring.custom_price
                ELSE market_monitoring.price * market_monitoring.quantity
            END
        ) as total
    ")
            ->where('products.user_id', auth()->id())
            ->whereBetween('market_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupByRaw("DAYNAME(market_monitoring.market_date)")
            ->get()
            ->pluck('total', 'dayname');

        // ✅ Same structure as $topSelling
        $dailyData = $daysOfWeek->map(function ($day) use ($dailyRaw) {
            return [
                'label' => $day,
                'total' => $dailyRaw[$day] ?? 0
            ];
        })->toArray();





        // Basic Stats (avg, max, min prices)
        $priceStats = MarketMonitoring::select(
            'product_id',
            DB::raw('AVG(price) as avg_price'),
            DB::raw('MAX(price) as max_price'),
            DB::raw('MIN(price) as min_price')
        )
            ->whereIn('product_id', $productsWithLogs->pluck('id'))
            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');

        // ✅ Supply: still based on quantity, no custom_price here
        $supplyData = MarketMonitoring::select('product_id', DB::raw('SUM(quantity) as total_supply'))
            ->whereIn('product_id', $productsWithLogs->pluck('id'))
            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');

        // ✅ Demand: quantity ordered only from COMPLETED orders
        $demandData = Orders::select('product_id', DB::raw('SUM(quantity) as total_demand'))
            ->whereIn('product_id', $productsWithLogs->pluck('id'))

            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');

            $supplyDemand = [];

        foreach ($productsWithLogs as $product) {
            $pid = $product->id;

            $supplyDemand[$product->title] = [
                'supply' => $supplyData[$pid]->total_supply ?? 0,
                'demand' => $demandData[$pid]->total_demand ?? 0,
            ];
        }

        // ✅ Cost: use custom_price if set, else price * quantity
        $costData = MarketMonitoring::select('product_id', DB::raw("
    SUM(
        CASE
            WHEN custom_price > 0 THEN custom_price
            ELSE price * quantity
        END
    ) as total_cost
"))
            ->whereIn('product_id', $productsWithLogs->pluck('id'))
            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');

        // ✅ Revenue: same principle — use custom_price * quantity if custom_price exists
        $revenueData = Orders::select('product_id', DB::raw("
    SUM(
        CASE
            WHEN custom_price > 0 THEN custom_price * quantity
            ELSE 0
        END
    ) as total_revenue
"))
            ->whereIn('product_id', $productsWithLogs->pluck('id'))
            ->where('status', 'completed')
            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');


        // Top Selling
        $topSelling = Orders::select(
            'product_id',
            DB::raw('SUM(quantity) as total_sold'),
            DB::raw('SUM(IF(custom_price > 0, custom_price * quantity, 0)) as revenue')
        )
            ->whereIn('product_id', $productsWithLogs->pluck('id'))
            ->groupBy('product_id')
            ->with('product')
            ->get()
            ->keyBy('product_id');

        // Combine results per product
        $averages = [];
        $highs = [];
        $lows = [];
        $supplyDemand = [];
        $profitCostData = [];

        foreach ($productsWithLogs as $product) {
            $pid = $product->id;

            $averages[$product->title] = $priceStats[$pid]->avg_price ?? 0;
            $highs[$product->title] = $priceStats[$pid]->max_price ?? 0;
            $lows[$product->title] = $priceStats[$pid]->min_price ?? 0;

            $supplyDemand[$product->title] = [
                'supply' => $supplyData[$pid]->total_supply ?? 0,
                'demand' => $demandData[$pid]->total_demand ?? 0,
            ];

            $cost = $costData[$pid]->total_cost ?? 0;
            $revenue = $revenueData[$pid]->total_revenue ?? 0;

            $profitCostData[$product->title] = [
                'cost' => $cost,
                'revenue' => $revenue,
                'profit' => $revenue - $cost,
            ];
        }



        return view('seller.analysis.marketanalysis', compact(
            'products',
            'productsWithLogs',
            'averages',
            'highs',
            'lows',
            'supplyDemand',
            'topSelling',
            'profitCostData',
            'monthlyData',
            'dailyData'
        ));
    }



    public function marketstore(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price' => 'required_without:custom_price|numeric',
            'custom_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'market_date' => 'required|date',
        ]);

        MarketMonitoring::create([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'custom_price' => $request->custom_price ?? null,
            'quantity' => $request->quantity,
            'market_date' => $request->market_date,
        ]);



        return redirect()->route('seller.analysis.marketanalysis')->with('success', 'Market data added!');
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
