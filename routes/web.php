<?php

use App\Http\Controllers\dashboard\admin\AdminCategoryController;
use App\Http\Controllers\dashboard\admin\AdminCompanyinfoController;
use App\Http\Controllers\dashboard\admin\AdminFaqController;
use App\Http\Controllers\dashboard\admin\AdminHomeBannerController;
use App\Http\Controllers\dashboard\admin\AdminHomeSectionController;
use App\Http\Controllers\dashboard\admin\AdminInboxController;
use App\Http\Controllers\dashboard\admin\AdminNotesController;
use App\Http\Controllers\dashboard\admin\AdminOrderController;
use App\Http\Controllers\dashboard\admin\AdminOrderDetailsController;
use App\Http\Controllers\dashboard\admin\AdminProductController;
use App\Http\Controllers\dashboard\admin\AdminSocialMediaController;
use App\Http\Controllers\dashboard\admin\AuthController;
use App\Http\Controllers\dashboard\admin\IndexController;
use App\Http\Controllers\dashboard\admin\StockController;
use App\Http\Controllers\dashboard\admin\UserController;
use App\Http\Controllers\dashboard\admin\AdminHomeController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;

use Illuminate\Support\Facades\Route;

// Web routes 
Route::get('/',[HomeController::class,'index'])->name('web.home');
Route::get('/contact-us',[ContactController::class,'index'])->name('web.contact');
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('web.send.email');
Route::get('/products',[ProductController::class,'index'])->name('web.product');
Route::get('/cart',[CartController::class,'index'])->name('web.cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('web.checkout');
Route::post('/checkout-mail', [CheckoutController::class, 'sendEmail'])->name('send.email');
Route::post('/create-order', [CheckoutController::class, 'placeorder'])->name('place.order');
Route::post('/cart/add', [CartController::class, 'add'])->name('session.cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/update-cart', [CartController::class, 'updateCart']);
Route::get('/get-cart', [CartController::class, 'getCart'])->name('get-cart');
Route::post('/inquiry-submit', [ContactController::class, 'store'])->name('inquiry.submit');
Route::post('/remove-cart-item', [CartController::class, 'removeCartItem']);
Route::get('/terms-and-conditions',[ContactController::class,'terms'])->name('web.terms-conditions');
Route::get('/privacy-and-policy',[ContactController::class,'privacy'])->name('web.privacy-policy');
Route::get('/cancel-and-refund',[ContactController::class,'refund'])->name('web.cancel-refund');




//ADMIN-DASHBOARD
//dashboard-auth
Route::get('/admin', [AuthController::class, 'loginPage'])->name('/admin');
Route::post('/admin-login', [AuthController::class, 'Login'])->name('admin-login');
Route::get('/app-dashboard',[AuthController::class,'dashboard']);
Route::post('admin-logout',[AuthController::class,'logout'])->name('admin-logout');

Route::middleware(['isAdmin', 'prevent.back'])->prefix('admin')->group(function () {

    // Index/Home Controller
    Route::controller(IndexController::class)->group(function () {
        Route::get('/dashboard', 'home')->name('/home');
        Route::get('/admin-profile', 'adminProfile')->name('admin-profile');
        Route::post('/update-adminprofile/{id}', 'adminUpdate')->name('adminprofile.update/{id}');
    });

    Route::get('/home', [AdminHomeController::class, 'index'])->name('home.dashboard');

    // User Controller
    Route::controller(UserController::class)->group(function () {
        Route::get('/add-users', 'create')->name('users.add');
        Route::get('/users', 'index')->name('users.show');
        Route::get('/customers', 'customers')->name('customers.show');
        Route::post('/add-users', 'store')->name('user.store');
        Route::post('/update-users/{id}', 'update')->name('user.update/{id}');
        Route::post('/delete-users/{id}', 'destroy')->name('user.delete/{id}');
        Route::post('/admin/user/toggle-status-ajax', 'toggleStatus')->name('admin.user.toggleStatusAjax');
    });

    // Category Controller
    Route::controller(AdminCategoryController::class)->group(function () {
        Route::get('/add-category', 'create')->name('category.add');
        Route::get('/categories', 'index')->name('category.show');
        Route::post('/add-category', 'store')->name('category.store');
        Route::post('/update-category/{id}', 'update')->name('category.update/{id}');
        Route::post('/delete-category/{id}', 'destroy')->name('category.delete/{id}');
        Route::post('/admin/category/toggle-status-ajax',  'toggleStatus')->name('admin.category.toggleStatus');
    });

    // Product Controller
    Route::controller(AdminProductController::class)->group(function () {
        Route::get('/add-product', 'create')->name('product.add');
        Route::get('/product', 'index')->name('admin.product.show');
        Route::post('/add-product', 'store')->name('product.store');
        Route::get('/edit-product/{id}', 'edit')->name('admin.product.edit');
        Route::post('/update-product/{id}', 'update')->name('product.update/{id}');
        Route::post('/delete-product/{id}', 'destroy')->name('product.delete/{id}');
        Route::get('/products/export', 'export')->name('products.export');
        Route::post('/products/import', 'import')->name('products.import');
        Route::post('/admin/product/toggle-status-ajax', 'toggleStatus')->name('admin.product.toggleStatusAjax');
    });

    // Company Info Controller
    Route::controller(AdminCompanyinfoController::class)->group(function () {
        Route::get('/company-info', 'index')->name('admin.companyinfo.show');
        Route::post('/add-company-info', 'store')->name('admin.companyinfo.store');
        Route::post('/update-company-info/{id}', 'update')->name('admin.companyinfo.update/{id}');
    });

    // Home Section Controller
    Route::controller(AdminHomeSectionController::class)->group(function () {
        Route::get('/home-sections', 'index')->name('admin.homesection.show');
        Route::get('/home-sections/add', 'create')->name('admin.homesection.add');
        Route::post('/add-home-section', 'store')->name('admin.homesection.store');
        Route::post('/update-home-section/{id}', 'update')->name('admin.homesection.update/{id}');
        Route::post('/delete-home-section/{id}', 'delete')->name('admin.homesection.delete/{id}');
        Route::post('/admin/section/toggle-status-ajax', 'toggleStatus')->name('admin.section.toggleStatusAjax');
    });

    // Home Banner Controller
    Route::controller(AdminHomeBannerController::class)->group(function () {
        Route::get('/home-banner', 'index')->name('admin.homebanner.show');
        Route::get('/home-banner/add', 'create')->name('admin.home-banner.add');
        Route::post('/add-home-banner', 'store')->name('admin.homebanner.store');
        Route::post('/update-home-banner/{id}', 'update')->name('admin.homebanner.update/{id}');
        Route::post('/home-banner-delete/{id}', 'delete')->name('admin.homebanner.delete/{id}');
    });

    // Notes Controller
    Route::controller(AdminNotesController::class)->group(function () {
        Route::post('/notes/store', 'store')->name('admin.notes.store');
        Route::post('/delete-notes/{id}', 'delete')->name('admin.notes.delete/{id}');
    });

    // FAQ Controller
    Route::controller(AdminFaqController::class)->group(function () {
        Route::get('/faq', 'index')->name('admin.faq.show');
        Route::get('/faq/add', 'create')->name('admin.faq.add');
        Route::post('/faq/store', 'store')->name('admin.faq.store');
        Route::post('/update-faq/{id}', 'update')->name('admin.faq.update/{id}');
        Route::post('/delete-faq/{id}', 'delete')->name('admin.faq.delete/{id}');
    });

    // Inbox Controller
    Route::controller(AdminInboxController::class)->group(function () {
        Route::get('/inbox', 'index')->name('admin.inbox.show');
        Route::post('/delete-ininbox/{id}', 'delete')->name('admin.inbox.delete/{id}');
        Route::post('/inbox/{id}/mark-as-read', 'markAsRead')->name('admin.inbox.markAsRead');
    });

    // Order Controller
    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('admin.order.show');
        Route::get('/order/add', 'create')->name('admin.order.add');
        Route::post('/order/store', 'store')->name('admin.order.store');
        Route::get('/update-order/{id}', 'update')->name('admin.order.update/{id}');
        Route::post('/delete-order/{id}', 'delete')->name('admin.order.delete/{id}');
        Route::post('/orders/{id}/update-status', 'updateOrderStatus')->name('admin.update.status.order');
        Route::post('/admin/orders/{id}/update-payment-status', 'updatePaymentStatus')->name('admin.payment.update');
    });

    // Order Details Controller
    Route::controller(AdminOrderDetailsController::class)->group(function () {
        Route::post('/order-item/update-status/{id}', 'updateStatus')->name('admin.order-item.updateStatus');
        Route::post('/order-items/bulk-update-status', 'bulkUpdateStatus')->name('admin.orders.bulk-update-status');
        Route::get('/orders/{order}/check-status', 'checkStatus')->name('admin.orders.check-status');
        Route::post('/orders/bulk-payment-status-update/{id}', 'bulkPaymentStatusUpdate')->name('admin.payment.statusupdate');
    });

    // Social Media Controller
    Route::controller(AdminSocialMediaController::class)->group(function () {
        Route::get('/social-media', 'index')->name('admin.socialmedia.show');
        Route::get('/social-media/add', 'create')->name('admin.socialmedia.add');
        Route::post('/social-media/store', 'store')->name('admin.socialmedia.store');
        Route::post('/update-social-media/{id}', 'update')->name('admin.socialmedia.update/{id}');
        Route::post('/delete-social-media/{id}', 'delete')->name('admin.socialmedia.delete/{id}');
    });

    // Stock Controller
    Route::controller(StockController::class)->group(function () {
        Route::get('/product-stocks', 'index')->name('admin.stock.show');
        Route::post('/products/import-stock',  'importStock')->name('products.import.stock');
        Route::get('/products/export-stock', 'export')->name('products.export.stock');
        Route::post('/admin/product/toggle-instock-ajax', 'toggleInStock')->name('admin.stock.toggleInStockAjax');
    });

});