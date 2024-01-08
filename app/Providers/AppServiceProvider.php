<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Season;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

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
		if(!$this->app->request->ajax()){
			Log::info('get seasons');
			$seasons = Season::where('enabled',1)
				->with(["batches" => function($q){
					$q->where('batches.enabled', 1);
				}])
				->get();
			View::share('admin_seasons', $seasons);
        }
		
		//Paginator::useBootstrapFive();
		Paginator::useBootstrap();
    }
}
