<?php

use Illuminate\Database\Seeder;

use App\Http\Api\OrdersApi;
use App\Http\Api\ProductsApi;
use App\Http\Api\UsersApi;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        OrdersApi::storeOrdersFromApi();
        ProductsApi::storeProductFromApi();
        UsersApi::storeCustomersFromApi();

        

    }
}
