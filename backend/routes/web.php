<?php

use Illuminate\Support\Facades\Route;

// Backend Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'dashboard']], function () {
    // dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // affilaite dashboard
    Route::get('affiliate', 'DashboardController@affiliate')->name('affiliate');

    // user 
    Route::resource('user', 'UserController');
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::post('profile', 'UserController@update_profile')->name('user.profile.update');
    Route::get('user-kyc', 'UserController@user_kyc')->name('user.kyc');
    Route::get('user-kyc/{id}/verify', 'UserController@verify_kyc')->name('user.kyc.verify');

    // product category
    Route::resource('product-category', 'ProductCategoryController');
    Route::resource('subcategory', 'SubCategoryController');

    //product
    Route::resource('product', 'ProductController');
    Route::get('product-import', 'ProductController@import')->name('product.import');
    Route::post('product-import', 'ProductController@store_import')->name('product.import.store');
    Route::get('product/{id}/gallery', 'ProductController@gallery')->name('product.gallery');
    Route::post('product/{id}/gallery', 'ProductController@gallery_store')->name('product.gallery.store');
    Route::delete('product/gallery/{id}/delete', 'ProductController@destroy_gallery')->name('product.gallery.destroy');
    Route::get('product/gallery/{id}/edit', 'ProductController@edit_gallery')->name('product.gallery.edit');
    Route::put('product/gallery/{id}/edit', 'ProductController@update_gallery')->name('product.gallery.update');
    Route::get('product-stock', 'ProductController@out_of_stock')->name('product.stock');

    // Product attribute routes
    Route::get('product/{id}/attribute', 'ProductController@attribute')->name('product.attribute');
    Route::post('product/{id}/attribute', 'ProductController@attribute_store')->name('product.attribute.store');
    Route::delete('product/attribute/{id}/delete', 'ProductController@destroy_attribute')->name('product.attribute.destroy');

    // Product Brand
    Route::resource('product-brand', 'ProductBrandController');

    // Slider
    Route::get('slider', 'SliderController@edit')->name('slider.edit');
    Route::post('slider', 'SliderController@update')->name('slider.update');

    // Campaign
    Route::resource('campaign', 'CampaignController');
    Route::get('campaign/{id}/products', 'CampaignController@products')->name('campaign.product');
    Route::post('campaign/{id}/products', 'CampaignController@updateproducts')->name('campaign.product.update');

    // order
    Route::resource('order', 'OrderController');

    // shipping
    Route::resource('shipping', 'ShippingController');
    Route::resource('billing', 'BillingController');
    Route::resource('coupon', 'CouponController');

    // Settings
    Route::get('setting', 'SettingController@edit')->name('setting.edit');
    Route::post('setting', 'SettingController@update')->name('setting.update');

    // Affiliate
    Route::get('comission', 'AffiliateController@index')->name('comission.index');
    Route::post('comission', 'AffiliateController@update')->name('comission.update');
    Route::get('transaction', 'AffiliateController@transactions')->name('transaction.index');
    Route::get('transaction/{transaction}/edit', 'AffiliateController@edit_transaction')->name('transaction.edit');
    Route::post('transaction/{transaction}/edit', 'AffiliateController@transaction_update')->name('transaction.update');
    Route::get('transaction/request', 'AffiliateController@transaction_request')->name('transaction.request');

    Route::resource('rating', 'RatingController');

});


// Frontend routes
Route::get('/', 'DashboardController@welcome')->name('website');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@register')->name('register');
Route::get('password/reset', 'AuthController@forgot')->name('password.request');
Route::get('password/reset/{token}', 'AuthController@reset')->name('password.reset');

Route::get('test', 'TestController@index')->name('test.index');
Route::post('test', 'TestController@store')->name('test.user');

Route::get('get/subctegories/{id}', 'SubCategoryController@get_subcategories');
