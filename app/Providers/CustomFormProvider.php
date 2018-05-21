<?php

namespace App\Providers;

use  Form;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\HtmlString;


class CustomFormProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('sumthin', function($value, $count = 10, $start = 1)
            {
                $build = array();
                while ($count > 0)
                {
                    $build[] = sprintf('<input type="sumthun" value="%s" index="%s">',
                      $value, $start);
                    $start += 1;
                    $count -= 1;
                }
            return new HtmlString(join("\n", $build));
        });


        Form::component('bsInput', 'components.form.bs_input', ['name','type','options' =>[] ]);
        Form::component('bsChecable', 'components.form.bs_checkable',['name','type','options' =>[] ] );

        Form::component('bsButton', 'components.form.bs_button',['value','options' =>[] ] );
    }






    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
