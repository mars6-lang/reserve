<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Users\SellerApplication;
use App\Models\Users\reportprods;
use App\Notifications\SellerStatusNotification;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        if (Gate::denies('admin-access')) {
            return redirect('errors.403');
        }

        $allusers = User::where('id', '>=', '3')->paginate(10);

        return view('admin.users.index')
            ->with('allusers', $allusers);
    }

    public function userProdsReport()
    {
        $reports = reportprods::with('product', 'user')->latest()->paginate(20);
        return view('admin.userProdsReport.view', compact('reports'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = SellerApplication::findOrFail($id);
        $application->status = $request->status; // 'approved' or 'rejected'
        $application->save();

        return redirect()->back()->with('success', 'Application updated!');
    }

    public function userfeedback()
    {
        $allfeedbacks = DB::table('feedbacks')
            ->select('*')
            ->paginate(10);

        return view('admin.users.feedbacks.show')
            ->with('allfeedbacks', $allfeedbacks);
    }




    public function Apkindex()
    {
        $applications = SellerApplication::with('user')->latest()->get();
        return view('admin.userApkForm.Apkindex', compact('applications'));
    }

    public function approve($id)
    {
        $application = SellerApplication::findOrFail($id);

        // ✅ Update application status
        $application->update(['status' => 'approved']);

        // ✅ Update user flags
        $application->user->update([
            'is_seller' => 1,
            'is_verified_seller' => 1, // <- this enables the Verified Seller badge
        ]);

        return back()->with('success', 'Application approved successfully!');
    }

    public function reject($id)
    {
        $application = SellerApplication::findOrFail($id);

        $application->update(['status' => 'rejected']);

        return back()->with('error', 'Application rejected.');
    }

}
