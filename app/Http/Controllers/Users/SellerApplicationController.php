<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\SellerApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer|min:18',
            'address' => 'required|string',
            'store_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'business_permit' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'terms' => 'accepted',
        ]);

        $businessPermitPath = $request->file('business_permit')->store('seller_docs', 'public');
        $validIdPath = $request->file('valid_id')->store('seller_docs', 'public');

        SellerApplication::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'phone' => $request->phone,
            'business_permit' => $businessPermitPath,
            'valid_id' => $validIdPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('status', 'Your seller application has been submitted for review.');
    }
}
