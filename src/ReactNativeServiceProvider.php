<?php

namespace Quantic\ReactNative;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ReactNativeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../stubs/reactnative.php', 'reactnative');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePublishing();
    }

    /**
     * Configure the publishable resources offered by the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/reactnative.php' => config_path('reactnative.php'),
                __DIR__.'/../stubs/ReactNativeCreatePage.php' => app_path('Console/Commands/ReactNativeCreatePage.php'),
                __DIR__.'/../stubs/ReactNativeCompileAssets.php' => app_path('Console/Commands/ReactNativeCompileAssets.php'),
                __DIR__.'/../stubs/ReactNative' => app_path('ReactNative'),
            ], 'reactnative-support');

            /*$this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'reactnative-migrations');*/
        }
    }
}
