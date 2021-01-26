<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{
    /**
     * Display the product page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return ProductResource::collection(Product::all());
    }
}
