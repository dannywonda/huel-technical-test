<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Product;
use App\ProductVariant;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the stats calculations
     *
     * @return \Illuminate\Http\Response
     */
    public function orderStats()
    {
        // Count all orders
        $orders  = count(Order::all());
        // Count all customers
        $customers = count(User::all());
        // Count all products
        $products = count(Product::all());
        // Customer whoe has paid
        $paidCustomers = count(Order::where('financial_status', '=', '2')->get());
        // Product with the variants
        $productId = 5365799256230;
        $variantProducts = count(ProductVariant::where('product_id', '=', $productId)->get());
      
        return [
            // Return the mean average order value across all customers
            'averageCustomerOrder'      => round($customers / $orders, 1),
            // Return the mean average order value of a specific customer
            'averageSpecificCustomer'   => round($paidCustomers / $orders, 1),
            // Return the mean average order value of a specific variant
            'averageSpecificVariant'    => round($variantProducts / $orders, 1),
            // Total number of Orders
            'totalNoOfOrders'           => $orders,
            // Total numbers of Customers
            'totalNoOfCustomers'        => $customers,
            // Total numbers of Products
            'totalNoOfProducts'         => $customers,
        ];
    }
}
