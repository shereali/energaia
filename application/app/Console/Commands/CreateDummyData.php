<?php

namespace App\Console\Commands;

use App\User;
use App\Category;
use Illuminate\Console\Command;
use App\Product;

class CreateDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate dummy data for this application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userData = [
            [
                'name'      => 'Jone Doe',
                'email'     => 'admin@company.com',
                'user_type' => 'company',
                'password'  => '$2y$10$P.qyY4a1SrSqvtGqkC5QTOLvxkCbpnJ/RA493qtR8e7wjRq0gBWj2'
            ],
            [
                'name'      => 'Supplier',
                'email'     => 'admin@supplier.com',
                'user_type' => 'supplier',
                'password'  => '$2y$10$P.qyY4a1SrSqvtGqkC5QTOLvxkCbpnJ/RA493qtR8e7wjRq0gBWj2' 
            ],
        ];
        
        foreach ($userData as $user) {
            $table            = new User;
            $table->name      = $user['name'];
            $table->email     = $user['email'];
            $table->user_type = $user['user_type'];
            $table->password  = $user['password'];
            $table->save();
        }

        $categoryData = [
            ['category_name' => 'Men'],
            ['category_name' => 'Women'],
            ['category_name' => 'Cosmetics'],
            ['category_name' => 'Cloth'],
            ['category_name' => 'Jewelry'],
            ['category_name' => 'Backpack'],
            ['category_name' => 'Electronics'],
            ['category_name' => 'Mobile'],
            ['category_name' => 'Computer'],
            ['category_name' => 'Laptop'],
            ['category_name' => 'Others'],
        ];

        foreach ($categoryData as $category) {
            $table                = new Category;
            $table->category_name = $category['category_name'];
            $table->save();
        }

        $productData = [
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 1,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 2,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 3,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 4,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 5,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 6,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 7,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 8,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 9,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
            [   'product_name'     => 'SUMMER BREAK',
                'product_image'    => 'summer.jpg',
                'category_id'      => 10,
                'product_price'    => 2000,
                'product_quantity' => 100,
            ],
        ];

        foreach ($productData as $key => $product) {
            $table                   =  new Product;
            $table->product_name     = $product['product_name'];
            $table->product_image    = $product['product_image'];
            $table->category_id      = $product['category_id'];
            $table->product_price    = $product['product_price'];
            $table->product_quantity = $product['product_quantity'];
            $table->save();
        }

        $this->info('
        Users, category and product list has been created!
        company email: admin@compay.com password: admin123456 
        Supplier email: admin@supplier.com password: admin123456'
        );
    }
}
