<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\adminToolController;




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
Route::get('/Home', function () {
    if (Auth::user()->roles[0]->name == "admin") {
        return view('admin.dashboard');
    } elseif (Auth::user()->roles[0]->name == "seller") {
        return view('seller.dashboard'); // your seller homepage view
    } else {
        return view('users.HomePage'); // regular user homepage
    }



})->middleware(['auth', 'verified'])->name('Home');




//for notification
Route::post('/notifications/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return back();
})->name('markNotificationRead');
Route::post('/notifications/read-all', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('markAllNotificationsRead');



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

            //user dashboard
            Route::resource('/HomePage', 'HomePageController');

            //dashboard
            Route::resource('/dashboard', 'DashboardController');
            Route::delete('/destroy/{id}', 'DashboardController@destroy')->name('Destroy');
            Route::post('/register', 'DashboardController@register')->name('register')->middleware('auth');


            //register account to seller route shit
            Route::get('/registeraccount', 'DashboardController@registeraccount')->name('registeraccount');

            Route::get('/addprods', function () {
                return view('users.addproduct.create');

            });


            // User places an order
            Route::post('/order', 'orderController@prodsDetailsStore')->name('order');
            Route::get('/myOrders', 'prodsDetailsCRTL@myOrders')->name('myOrders');
            Route::patch('/cancelorders/{order}', 'orderController@cancel')->name('orders.cancel');

            //report some shit
            Route::get('/ProdsReport/{id}', 'prodsDetailsCRTL@ProdsReport')->name('ProdsReport');
            Route::post('/ProdsReport/{id}', 'prodsDetailsCRTL@reportstore')->name('ProdsReport');

            //market products displays and some analysis routes
            Route::resource('/Market', 'marketController');
            Route::get('/prodsDetails/{id}', 'marketController@prodsDetails')->name('prodsDetails');


            //contact and about route
            //Route::get('/contactUs', 'HomePageController@contactsindex')->name('contactsindex');
            Route::get('/about', 'HomePageController@about')->name('about');



            //review and comments ratings
            Route::post('/prodsDetails/{id}', 'reviewCommentsController@store')->name('reviews.store');


            Route::post('/reviews/{review}', 'reviewCommentsController@replyStore')->middleware('auth')->name('reviews.reply');






        });







//seller shits
Route::group([
    'namespace' => 'App\Http\Controllers\Seller',
    'prefix' => 'seller',
    'as' => 'seller.',
    'middleware' => ['auth', 'is_seller',]
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
    //route for manage prods EDIT BTN
    Route::get('/sellerManageProds/{products}/ManageProdsEdit', 'SellerController@ManageProdsEdit')->name('sellerManageProds.ManageProdsEdit');

    //for seller order list
    Route::get('/ordersList', 'SellerController@ordersList')->name('ordersList');
    Route::patch('/seller/orders/{order}/complete', 'SellerController@markCompleted')->name('markCompleted');

    //route for notifications
    Route::get('/notification', 'SellerController@notindex')->name('notindex');
    Route::delete('/notification/{id}', 'SellerController@notidelete')->name('notidelete');
    Route::delete('/notification', 'SellerController@deleteall')->name('deleteall');


    //market monitoring
    Route::get('/market-analysis', 'SellerController@marketanalysis')->name('analysis.marketanalysis');
    Route::post('/market-monitoring/store', 'SellerController@marketstore')->name('marketstore');

});




Route::middleware('auth')->get('/become-seller', function () {
    Auth::user()->update(['is_seller' => true]);
    return redirect('/seller/dashboard')->with('success', 'You are now a seller!');

});

Route::get('/dashboard', function () {
    return view('dashboard');


})->middleware('auth');

require __DIR__ . '/auth.php';
