<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Show all notifications for the authenticated user
     */
    public function index()
    {
        $user = auth()->user();

        // Fetch all notifications (including read/unread)
        $notifications = $user->notifications()->latest()->get();


        return view('notifications.index', compact('notifications'));
    }



    /**
     * Mark a single notification as read
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }

    public function markAsReadAndRedirect($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        // Mark as read
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        // Redirect to reserved list
        return redirect()->route('seller.reservedList');
    }


    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a single notification
     */
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }

    /**
     * Delete all notifications
     */
    public function destroyAll()
    {
        \DB::table('notifications')
            ->where('notifiable_id', Auth::id())
            ->delete();

        return back()->with('success', 'All notifications permanently deleted.');
    }



    /**
     * Check if the authenticated user has unread notifications (JSON endpoint)
     */
    public function check()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['hasUnread' => false]);
        }

        // Only check notifications for this user
        $hasUnread = $user->unreadNotifications()->exists();

        return response()->json(['hasUnread' => $hasUnread]);
    }

    public function open($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        if (!$notification->read_at) {
            $notification->markAsRead();
        }

        return redirect($notification->data['url'] ?? route('notifications.index'));
    }




}
