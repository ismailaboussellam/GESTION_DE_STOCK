<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $categories = [
        'Electronics',
        'Clothing',
        'Home Appliances',
        'Furniture',
        'Books',
        'Sports Equipment',
        'Toys',
        'Beauty & Personal Care',
        'Office Supplies',
        'Kitchen & Dining',
        'Automotive',
        'Garden & Outdoor',
        'Health & Wellness',
        'Pet Supplies',
        'Tools & Hardware'
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        // Create categories from predefined list
        $categories = collect($this->categories)->map(function ($name) {
            return Category::create(['name' => $name]);
        });

        // Create base data
        $suppliers = Supplier::factory(10)->create();
        $stores = Store::factory(5)->create();

        // Create products with existing suppliers and categories
        $products = Product::factory(50)
            ->recycle($suppliers)
            ->recycle($categories)
            ->create();

        // Create stocks for products in stores
        Stock::factory(100)
            ->recycle($products)
            ->recycle($stores)
            ->create();

        // Create customers and their orders
        $customers = Customer::factory(20)->create();
        $orders = Order::factory(30)
            ->recycle($customers)
            ->create();

        // Create transactions for orders and stocks
        Transaction::factory(50)->create();
    }
}
