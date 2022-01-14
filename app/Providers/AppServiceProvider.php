<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Video;
use App\Models\Order;
use App\Models\Blog;
use App\Models\CategoryBlog;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            //Bieu do tron
        $chinhsach = CategoryBlog::where('id',6)->get();
        $tk_product = Product::all()->count();
        $tk_post = Blog::all()->count();
        $tk_video = Video::all()->count();
        $tk_customer = Customer::all()->count();
        $tk_order = Order::all()->count();
        
        $view->with(compact('tk_product','tk_post','tk_video','tk_customer','tk_order','chinhsach'));
        });
    }
}
