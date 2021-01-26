<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Product;
use App\ProductVariant;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    
    /**
     * Display the orders page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return OrderResource::collection(Order::all());
    }

    
}
