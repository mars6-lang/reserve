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
        $request->validate([
            'comment' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $product = \App\Models\Users\products::findOrFail($id); // use $id here

        $review = \App\Models\Users\reviewcomments::create([
            'user_id' => auth()->id(),
            'product_id' => $id, // use $id here as well
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Notify the seller (if commenter is not the seller)
        if ($product->user) {
            $product->user->notify(new NewReviewNotification(
                auth()->user()->name,
                $product->id,
                $product->image ?? null
            ));
        }

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

}
