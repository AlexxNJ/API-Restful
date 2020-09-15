<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        User::truncate();
        DB::table('category_product')->truncate();

        $cantidadUsuarios = 1000;
        $cantidadCategorias = 30;
        $cantidadProductos = 1000;
        $cantidadTransacciones = 1000;

        factory(User::class,$cantidadUsuarios)->create();
        factory(Category::class,$cantidadUsuarios)->create();
        
        factory(Product::class,$cantidadProductos)->create()->each(
            function($producto){
                $cateogiras = Category::all()->random(mt_rand(1,5))->pluck('id');

                $producto->categories()->attach($cateogiras);
            }
        );
        
        factory(Transaction::class,$cantidadTransacciones)->create();
        
    }
}
