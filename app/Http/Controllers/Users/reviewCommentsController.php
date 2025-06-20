<?php

namespace App\Http\Controllers\Users;
use App\Models\Users\products;
use App\Http\Controllers\Controller;
use App\Models\Users\replies;
use Illuminate\Http\Request;

class reviewCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'photo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('review_photos', 'public');
        }

        $product = products::findOrFail($id);

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'photo' => $photoPath, // ✅ make sure this is included
        ]);

        return redirect()->route('users.prodsDetails', $id)->with('success', 'Review submitted!');
    }


    public function replyStore(Request $request, $reviewId)
    {
        $request->validate([
            'reply' => 'required|string|max:120',  // was 'replies' before
        ]);

        replies::create([
            'review_id' => $reviewId,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        return back()->with('success', 'Reply posted!');
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
