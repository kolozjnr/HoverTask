<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\V1\WalletController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\WishlistController;
use App\Http\Controllers\Api\V1\ReviewController;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//Route::post('/send-reset-link', [AuthController::class, 'resetPasswordRequest'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

//protected routes TASK
Route::prefix('v1')->group(function () {
    Route::prefix('tasks')->middleware('auth:sanctum')->group(function () {
        Route::post('/create-task', [TaskController::class, 'createTask'])->name('create.task');
        Route::post('/update-task/{id}', [TaskController::class, 'updateTask'])->name('update.task');
        Route::get('/show-all-task', [TaskController::class, 'showAll'])->name('show.all');
        Route::get('/show-task/{id}', [TaskController::class, 'show'])->name('show.task');
        Route::post('/submit-task/{id}', [TaskController::class, 'submitTask'])->name('submit.task');
    });
});

//product routes
Route::prefix('v1')->group(function () {
    Route::prefix('products')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/create-product', [ProductController::class, 'store'])->name('product.store');
        Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::post('/approve-product/{id}', [ProductController::class, 'approveProduct'])->name('product.approve');
        Route::get('/show-product/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/show-all-product', [ProductController::class, 'showAll'])->name('product.showAll');
        Route::get('/location/{location}', [ProductController::class, 'productByLocation'])->name('product.location');
        //generate link
        Route::post('/reseller-link/{id}', [ProductController::class, 'resellerLink'])->name('product.resellerLink');    
    });

    Route::prefix('wishlists')->middleware('auth:sanctum')->group(function () {
        Route::post('/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
            Route::delete('/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
            Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    });
    Route::prefix('cart')->middleware('auth:sanctum')->group(function () {
    Route::post('/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cartitems', [CartController::class, 'index'])->name('cart.index');
    });
    Route::prefix('wallet')->middleware('auth:sanctum')->group(function () {
        Route::post('/initialize-payment', [WalletController::class, 'initializePayment'])->name('wallet.initialize');
        Route::post('/verify-payment', [WalletController::class, 'verifyPayment'])->name('wallet.verify');
        Route::get('/balance', [WalletController::class, 'getBalance'])->name('wallet.balance');
    });

    Route::prefix('payment')->middleware('auth:sanctum')->group(function () {
        Route::post('/initialize-payment', [OrderController::class, 'pay']);
        Route::get('/verify-payment/{reference}', [OrderController::class, 'verify']);
    });

    Route::prefix('reviews')->middleware('auth:sanctum')->group(function () {
        Route::post('/reviews', [ReviewController::class, 'store']);
        Route::get('/reviews/{productId}', [ReviewController::class, 'getReviews']);
    });
    
    //Route::get('/get-product/{id}', [ProductController::class, 'show'])->name('product.show');
});




// Route::middleware('auth:sanctum')->prefix('api/v1')->group(function () {
//     Route::get('/products/show-product/{id}', [ProductController::class, 'show']);
// });


//Categories routes
Route::prefix('v1')->group(function () {
    Route::prefix('categories')->middleware('auth:sanctum')->group(function () {
        Route::post('/create', [CategoryController::class, 'create'])->name('category.create');
        //Route::post('/create-product', [CategoryController::class, 'store'])->name('product.store');
    });
});







//product routes

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});