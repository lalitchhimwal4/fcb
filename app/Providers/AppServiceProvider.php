<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if(Schema::hasTable('page_meta_tags')) {
            config(updatePaypalConfigVariable()); //this function updatePaypalConfigVariable is helper function
        }
        if(env('APP_ENV') !=='local'){
            URL::forceScheme('https');
        }
    }
}
