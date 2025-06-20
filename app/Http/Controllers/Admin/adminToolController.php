<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\SellerStatusNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Users\reportprods;


class adminToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    public function warning($id)
    {
        $seller = User::findOrFail($id);
        $seller->status = 'warned';
        $seller->save();

        // Send notification
        Notification::send($seller, new SellerStatusNotification('warned'));


        return back()->with('success', 'Seller has been warned.');
    }

    // Suspend seller
    public function suspend($id)
    {
        $seller = User::findOrFail($id);
        $seller->status = 'suspended';
        $seller->save();

        // Send notification
        Notification::send($seller, new SellerStatusNotification('suspended'));

        return back()->with('success', 'Seller has been suspended.');
    }

    // Ban seller
    public function ban($id)
    {
        $seller = User::findOrFail($id);
        $seller->status = 'banned';
        $seller->save();

        // Send notification
        Notification::send($seller, new SellerStatusNotification('banned'));

        return back()->with('success', 'Seller has been banned.');
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
}
