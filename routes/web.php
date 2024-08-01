<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller;

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( 'products', [ ProductController::class, 'index' ] )->name( 'product.index' );
Route::group( [ 'prefix' => 'product' ], function () {
    Route::get( '/{slug}', [ ProductController::class, 'show' ] )->name( 'product.item' );
} );
Route::group( [ 'prefix' => 'seller-area' ], function () {
    Route::group( [ 'prefix' => 'websites' ], function () {
        Route::get( '/', [ Seller\WebsitesController::class, 'index' ] )->name( 'seller.websites.index' );
        Route::get( '/add', [ Seller\WebsitesController::class, 'create' ] )->name( 'seller.websites.new' );
        Route::post( '/add', [ Seller\WebsitesController::class, 'store' ] )->name( 'seller.websites.store' );
        // Website Products
        Route::get( '/{website}/products', [ Seller\WebsiteProductsController::class, 'index' ] )->name( 'seller.website.products.index' );
        Route::get( '/{website}/products/add', [ Seller\WebsiteProductsController::class, 'create' ] )->name( 'seller.website.products.new' );
        Route::post( '/{website}/products/add', [ Seller\WebsiteProductsController::class, 'store' ] )->name( 'seller.website.products.store' );
    } );
} );
Route::get( '/mq/send', [ MessageController::class, 'send' ] )->name( 'message.send' );
