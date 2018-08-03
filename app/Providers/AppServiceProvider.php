<?php

namespace App\Providers;

use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor/pagination/bootstrap-4');

        Paginator::defaultSimpleView('vendor/pagination/simple-bootstrap-4');


        Blade::directive('money', function ($amount) {
               return "<?php echo '$ ' . number_format($amount, 2); ?>";
          });

        Blade::directive('percentage', function ($amount) {
               return "<?php echo  number_format($amount,2).'%' ; ?>";
          });



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
