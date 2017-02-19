<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(
            'layout.chrome',
            \App\Http\ViewComposers\NavComposer::class
        );
    } // end boot

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
//        $this->registerPolicies();
    } // end register
}
