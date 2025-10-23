<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route for the landing page 
Route::get('/', function () {
    return view('Home');
});



// redirects to specific dashboard based on the role of the user 
Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->roles[0]->name ?? 'user';

        if ($role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->is_seller) {
            // redirect to SellerController@index
            return redirect()->route('seller.dashboard.index');
        } else {
            // normal user → Market page
            return redirect()->route('users.Market.index');
        }
    }

    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Buyer and Seller notifications (same controller, different filters)
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/seller/notifications', [NotificationController::class, 'seller'])->name('notifications.seller');

    // Mark read / delete
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.delete');
    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('notifications.deleteAll');

    // JSON checks (for red dot display)
    Route::get('/notifications/check', [NotificationController::class, 'check'])->name('notifications.check');
    Route::get('/seller/notifications/check', [NotificationController::class, 'sellerCheck'])->name('notifications.sellerCheck');

    Route::get('/notifications/open/{id}', [NotificationController::class, 'open'])
        ->name('notifications.open');
});




//caht room
Route::middleware('auth')->group(function () {
    Route::get('/chatroom', [ChatController::class, 'index'])->name('chatroom.index');
    Route::get('/chatroom/{user}', 'App\Http\Controllers\ChatController@show')->name('chatroom.show');
    Route::post('/chatroom/{user}', 'App\Http\Controllers\ChatController@store')->name('chatroom.store');
});




// your profile actions
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin routes here 
Route::
        namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:admin-access')->group(function () {

            // add routes here for admin 
            Route::resource('/users', 'UserController', ['except' => ['create', 'store', 'destroy']]);
            Route::get('/userfeedbacks', 'UserController@userfeedback')->name('userfeedback');
            //user reports
            Route::get('/userProdsReport', 'UserController@userProdsReport')->name('userProdsReport');
            //admin actions to reported shits
            Route::post('/seller/{id}/warning', 'adminToolController@warning')->name('warning');
            Route::post('/seller/{id}/suspend', 'adminToolController@suspend')->name('suspend');
            Route::delete('/seller/{id}/ban', 'adminToolController@ban')->name('ban');


            //seller or user application form route
            Route::get('seller-applications', 'UserController@Apkindex')
                ->name('Apkindex')
                ->middleware('auth');

            Route::post('seller-applications/{id}/status', 'UserController@updateStatus')
                ->name('seller-applications.updateStatus')
                ->middleware('auth');



            Route::post('/seller-applications/{id}/approve', 'UserController@approve')
                ->name('admin.approve');

            Route::post('/seller-applications/{id}/reject', 'UserController@reject')
                ->name('admin.reject');








        });




// users routes here 
Route::
        namespace('App\Http\Controllers\Users')->prefix('users')->name('users.')->middleware('can:user-access')->group(function () {

            // add routes here for users 
            Route::resource('/feedback', 'CTRLFeedbacks', ['except' => ['update', 'edit', 'destroy']]);

            Route::get('/myfeedbacks', 'CTRLFeedbacks@myfeedback')->name('myfeedback');

            Route::resource('/products', 'CTRLproducts');

            // eto route ng search products
            Route::get('/searchproducts', 'CTRLproducts@searchproducts')->name('searchproducts');


            //dashboard
            Route::resource('/dashboard', 'DashboardController');
            Route::delete('/destroy/{id}', 'DashboardController@destroy')->name('Destroy');
            Route::post('/register', 'DashboardController@register')->name('register')->middleware('auth');


            //register account to seller 
            Route::get('/registeraccount', 'DashboardController@registeraccount')->name('registeraccount');

            Route::get('/addprods', function () {
                return view('users.addproduct.create');


            });

            Route::post('/registeraccount', 'SellerApplicationController@store')
                ->name('registeraccount')
                ->middleware('auth');


            // User places an order
            Route::post('/order', 'orderController@prodsDetailsStore')->name('order');
            Route::get('/myOrders', 'prodsDetailsCRTL@myOrders')->name('myOrders');
            Route::patch('/cancelorders/{order}', 'orderController@cancel')->name('orders.cancel');
            Route::patch('/orders/{order}/received', 'orderController@markReceived')->name('orders.markReceived');
            //repor
            Route::get('/ProdsReport/{id}', 'prodsDetailsCRTL@ProdsReport')->name('ProdsReport');
            Route::post('/ProdsReport/{id}', 'prodsDetailsCRTL@reportstore')->name('ProdsReport');


            //review and comments ratings
            Route::post('/prodsDetails/{id}', 'reviewCommentsController@store')->name('reviews.store');
            Route::post('/reviews/{review}', 'reviewCommentsController@replyStore')->middleware('auth')->name('reviews.reply');

            //users review on the prods they reviewed
            Route::get('/userReviews', 'reviewCommentsController@userReviews')->name('userReviews');

            //System messages
            Route::get('/systemMessages', 'DashboardController@systemMessages')->name('systemMessages');




            //item search users.itemSearch.index
            Route::resource('/searchView', 'CTRLproducts');
            Route::get('/searchView', 'CTRLproducts@searchIndex')->name('searchIndex');




            Route::get('/appinfo', 'HomePageController@about')->name('appinfo.about');


            Route::get('/market/category/{category}', 'marketController@Catindex')->name('users.ShopCategory.Catindex');













        });

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/HomePage', 'App\Http\Controllers\Users\HomePageController@index')->name('HomePage.index');
    Route::get('/Market', 'App\Http\Controllers\Users\marketController@index')->name('Market.index');
    Route::get('/prodsDetails/{id}', 'App\Http\Controllers\Users\marketController@prodsDetails')->name('prodsDetails');
});







//seller
Route::group([
    'namespace' => 'App\Http\Controllers\Seller',
    'prefix' => 'seller',
    'as' => 'seller.',
    'middleware' => ['auth', 'can:seller-access'],
], function () {
    // Seller Dashboard
    Route::resource('/dashboard', 'SellerController');
    //seller adding products
    Route::get('/sellerAdd', 'SellerController@sellerAdd')->name('sellerAdd');
    Route::post('/sellerStore', 'SellerController@sellerStore')->name('sellerStore');
    //seller product ratings
    Route::get('/productsRatings', 'SellerController@productsRatings')->name('productsRatings');
    //seller manage products
    Route::get('/sellerManageProds', 'SellerController@ManageProds')->name('ManageProds');
    Route::put('/sellerManageProds/{products}', 'SellerController@Prodsupdate')->name('sellerManageProds');
    Route::delete('/sellerprodsDelete/{id}', 'SellerController@deleteProds')->name('deleteProds');
    //route for manage prods EDIT BTN
    Route::get('/sellerManageProds/{products}/ManageProdsEdit', 'SellerController@ManageProdsEdit')->name('sellerManageProds.ManageProdsEdit');
    //for seller order list
    // Seller Orders List
    Route::get('/ordersList', 'SellerController@ordersList')->name('ordersList');

    // Mark as Completed
    Route::patch('/seller/orders/{order}/complete', 'SellerController@markCompleted')->name('seller.markCompleted');

    // Mark as Received
    Route::patch('/seller/orders/{order}/received', 'SellerController@markReceived')->name('seller.markReceived');

    //market monitoring
    Route::get('/market-analysis', 'SellerController@marketanalysis')->name('analysis.marketanalysis');
    Route::post('/market-monitoring/store', 'SellerController@marketstore')->name('marketstore');



    Route::post('/terms/accept', 'SellerController@accept')
        ->name('terms.accept')
        ->middleware(['auth', 'is_seller']);

});




Route::middleware('auth')->get('/become-seller', function () {
    Auth::user()->update(['is_seller' => true]);
    return redirect('/seller/dashboard')->with('success', 'You are now a seller!');

});





require __DIR__ . '/auth.php';
