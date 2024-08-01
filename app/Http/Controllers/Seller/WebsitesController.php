<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Website;

class WebsitesController extends Controller {
    public function index() {
        $sellerWebsites = Website::where( 'seller_id', 1 )->get();

        return view( 'seller-area.website.index', compact( 'sellerWebsites' ) );
    }

    public function create() {

        return view( 'seller-area.website.create' );
    }

    public function store() {

    }
}
