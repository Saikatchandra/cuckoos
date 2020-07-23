<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('login', 'ApiAuthController@login');
    Route::post('logout', 'ApiAuthController@logout');
    Route::post('refresh', 'ApiAuthController@refresh');
    Route::post('me', 'ApiAuthController@me');
    Route::post('register', 'ApiAuthController@register');
});

// Password  Reset
Route::post('forgot/password', 'ApiAuthController@password_reset_otp');
Route::post('reset/password', 'ApiAuthController@reset_password');

Route::get('setting', 'WebsiteController@setting');
Route::get('primary-menu', 'WebsiteController@primary_menu');
Route::get('required-data', 'WebsiteController@required_data');

// search page
Route::get('load/search-filter-data', 'WebsiteController@search_filter_data');

Route::get('category/{slug}', 'WebsiteController@category');
Route::get('category/search/{slug}', 'WebsiteController@category_search_products');
// Route::get('category/products/{slug}', 'WebsiteController@category_products');

Route::get('slider', 'WebsiteController@get_slider');

Route::get('products/popular', 'WebsiteController@popular_products');
Route::get('products/new', 'WebsiteController@new_products');
Route::get('products/recommend', 'WebsiteController@recommend_products');
// recommended page
Route::get('recommend', 'WebsiteController@recommended_page');

// product page
Route::get('product/{slug}', 'WebsiteController@product');
Route::get('products/related/{slug}', 'WebsiteController@related_products');

Route::get('ratings/{id}/', 'WebsiteController@ratings');

// Search Page
Route::get('search', 'WebsiteController@search');
Route::get('search/filter', 'WebsiteController@search_filter');

Route::post('coupon/check', 'WebsiteController@coupon');

Route::get('campaign', 'WebsiteController@campaign');
// Verif
Route::post('verify/otp', 'ApiAuthController@verify_otp');
Route::post('resend/otp', 'ApiAuthController@resend_otp');


// affiliate
Route::get('get/referrer/{username}', 'WebsiteController@get_referrer');

Route::group(['middleware' => 'api'], function() {
    Route::get('user', 'ApiController@user');

    Route::get('shipping', 'ApiController@shipping');
    Route::post('shipping', 'ApiController@store_shipping');
    Route::post('shipping/{id}', 'ApiController@update_shipping');
    Route::get('shipping/delete/{id}', 'ApiController@delete_shipping');

    // store order information
    Route::post('order', 'WebsiteController@order');
    // get order list
    Route::get('orders', 'ApiController@orders');
    Route::get('recent/orders', 'ApiController@recent_orders');

    // auth user
    Route::get('auth/user', 'ApiAuthController@auth_user');
    Route::post('auth/user', 'ApiAuthController@user_update');

    // check wallet and points
    Route::get('wallet', 'ApiController@wallet');
    Route::post('check/points', 'ApiController@check_points');

    // check affiliate data
    Route::get('affiliate', 'ApiController@get_affiliate');
    Route::get('affiliate/data', 'ApiController@get_affiliate_data');
    Route::get('get/referral/list', 'ApiController@referral_list');

    // get affiliate verification info
    Route::post('affiliate/verify', 'ApiController@kyc_store');
    Route::post('affiliate/update/', 'ApiController@kyc_update');
    Route::get('get/kyc', 'ApiController@get_kyc');
    // withdraw payment
    Route::post('withdraw', 'ApiController@withdraw');

    // coupons
    Route::get('coupons', 'ApiController@coupons');
    Route::get('transactions', 'ApiController@transactions');
    
    Route::get('dashboard', 'ApiController@dashboard_data');
});

Route::get('test', 'WebsiteController@test');
