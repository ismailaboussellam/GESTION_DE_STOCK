<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Log;
use App\Mail\Mycls;
use Illuminate\Support\Facades\Mail;

//pdf
Route::get('/products/print', [ProductController::class, 'print'])->name('products.print');


// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Email Verification Routes
Route::get('/email/verify', [AuthController::class, 'verificationNotice'])->name('verification.notice');
Route::get('/email/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/password/reset/{token}/{email}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Profile Routes
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::put('/password', [AuthController::class, 'updatePassword'])->name('password.change');

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/customers', [DashboardController::class, 'customers'])->name('customers.index');
Route::get('/suppliers', [DashboardController::class, 'suppliers'])->name('suppliers.index');
// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/api/products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products-by-category', [CategoryController::class, 'productsByCategory'])->name('products.by.category');
Route::get('/products-by-category/{category}', [CategoryController::class, 'getProductsByCategory'])->name('products.filter.by.category');

// Products by Supplier routes
Route::get('/products-by-supplier', [DashboardController::class, 'productsBySupplier'])->name('products.by.supplier');
Route::get('/api/products-by-supplier/{supplier}', [DashboardController::class, 'getProductsBySupplier'])->name('api.products.by.supplier');

// Products by Store routes
Route::get('/products-by-store', [DashboardController::class, 'productsByStore'])->name('products.by.store');
Route::get('/api/products-by-store/{store}', [DashboardController::class, 'getProductsByStore'])->name('api.products.by.store');

// Order routes
Route::get('/orders', [DashboardController::class, 'orders'])->name('orders.index');

// Customer routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::get('/customers/{customer}/delete', [CustomerController::class, 'delete'])->name('customers.delete');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

// Customer search API route
Route::get('/api/customers/search', [CustomerController::class, 'search'])->name('customers.search');
// Customer search API route
Route::get('/api/customers/search/{term}', [CustomerController::class, 'searchTerm'])->name('customers.search.term');

// Customer orders API route
Route::get('/api/customers/{customer}/orders', [OrderController::class, 'getCustomerOrders'])->name('customers.orders');

// Order details route
Route::get('/api/orders/{order}/details', [OrderController::class, 'getOrderDetails'])->name('orders.details');

//elqouent relationships
Route::get('/ordered-products', [App\Http\Controllers\ProductOrderController::class, 'index'])->name('ordered.products');
Route::get('/same-products-customers', [App\Http\Controllers\CustomerController::class, 'sameProductsCustomers'])->name('same.products.customers');
Route::get('products/orders-count', [\App\Http\Controllers\ProductController::class, 'ordersCount'])->name('products.orders_count');
Route::get('/products-more-than-6-orders', [App\Http\Controllers\ProductController::class, 'productsMoreThan6Orders'])->name('products.more_than_6_orders');
Route::get('/order-totals', [App\Http\Controllers\OrderController::class, 'orderTotals'])->name('orders.totals');
Route::get('/orders-greater-than-60', [OrderController::class, 'ordersGreaterThanOrder60'])->name('orders.greater_than_60');
Route::get('/orders-per-name', [OrderController::class, 'ordersPerName'])->name('orders.orders-per-name');

//language switcher
Route::get('/changeLocale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'es', 'fr', 'ar'])) {
        session()->put('locale', $locale);
     }
    return redirect()->back();
});


Route::get('/testmail', function() {
    $name = "ismo developpers";

    Mail::to('edramarouan@gmail.com')->send(new Mycls($name));
    return 'mail envoyé avec success';
});

                                    
Route::post("/saveCookie", [DashboardController::class, 'saveCookie'])->name("saveCookie");
Route::post("/saveSession", [DashboardController::class, 'saveSession'])->name("saveSession");
Route::post("/saveAvatar", [DashboardController::class, 'saveAvatar'])->name("saveAvatar");

//Excel 
Route::get('products-export', [ProductController::class, 'export'])->name('products.export');
Route::post('products-import', [ProductController::class, 'import'])->name('products.import');