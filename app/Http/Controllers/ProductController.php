<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;

class ProductController extends Controller {
    public function index() {
        $products = Product::all();

        return view( 'product.index', compact( 'products' ) );
    }

    public function show( $slug ) {
        $product = Product::with( 'websites' )->where( 'slug', $slug )->first();

        return view( 'product.show', compact( 'product' ) );
    }
}
