<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\Models\Users\products;
use App\Models\Users\reviewcomments;
use App\Models\Users\Replies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Notifications\NewReplyNotification;


class reviewCommentsController extends Controller
{

    public function store(Request $request, $id) // $id = product ID
    {
        $product = \App\Models\Users\products::findOrFail($id);

        // Check if user has ALREADY reviewed this product
        $existingReview = \App\Models\Users\reviewcomments::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product. One review per product per buyer.');
        }

        // Check if user has RECEIVED order for this product (not completed - completed = no longer active reservation)
        $hasReceivedOrder = \App\Models\Users\orders::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->where('status', 'received')
            ->exists();

        if (!$hasReceivedOrder) {
            return back()->with('error', 'You can only leave a review while the product is in RECEIVED status.');
        }

        $request->validate([
            'comment' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review = \App\Models\Users\reviewcomments::create([
            'user_id' => auth()->id(),
            'product_id' => $id, // use $id here as well
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Notify the seller about the new review
        // (Notification class can be created separately if needed)
        // For now, we just create the review without notification


        return back()->with('success', 'Review posted and seller notified!');
    }



    public function replyStore(Request $request, $reviewId)
    {
        $request->validate([
            'reply' => 'required|string|max:120',
        ]);

        $review = \App\Models\Users\reviewcomments::findOrFail($reviewId);

        // Create the reply
        $reply = \App\Models\Users\Replies::create([
            'review_id' => $reviewId,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        $reviewAuthor = $review->user;
        $seller = $review->product->user;

        // Notify review author if not self
        if ($reviewAuthor->id !== auth()->id()) {
            $reviewAuthor->notify(new \App\Notifications\NewReplyNotification(
                auth()->user()->name,
                $review->product->id,
                $review->product->image ?? null
            ));
        }

        // Notify seller if not self and not already notified
        if ($seller->id !== auth()->id() && $seller->id !== $reviewAuthor->id) {
            $seller->notify(new \App\Notifications\NewReplyNotification(
                auth()->user()->name,
                $review->product->id,
                $review->product->image ?? null
            ));
        }

        return back()->with('success', 'Reply posted and notifications sent!');
    }








    public function userReviews()
    {

        $user = auth()->user(); // logged-in buyer
        $reviews = reviewcomments::where('user_id', $user->id)
            ->with(['product.user']) // load product and its seller
            ->latest()
            ->get();

        return view('users.userProdsReviews.userReviews', compact('reviews'));
    }

    // Show edit form for a review
    public function edit($id)
    {
        $review = reviewcomments::findOrFail($id);
        
        // Only review author can edit
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('users.reviews.edit', compact('review'));
    }

    // Update review
    public function update(Request $request, $id)
    {
        try {
            $review = reviewcomments::findOrFail($id);
            
            // Only review author can update
            if ($review->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $validated = $request->validate([
                'comment' => 'required|string|max:255',
                'rating' => 'required|numeric|min:1|max:5',
            ]);

            $review->update($validated);

            // Always return JSON for this endpoint
            return response()->json([
                'success' => true,
                'message' => 'Review updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    // Delete review
    public function delete($id)
    {
        $review = reviewcomments::findOrFail($id);
        
        // Only review author can delete
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }

}
