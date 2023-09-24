<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Production public path.
        // TODO: search an approach to change the public_path().
        // refs: https://laracasts.com/discuss/channels/general-discussion/where-do-you-set-public-directory-laravel-5
        // https://developerhowto.com/2018/11/12/how-to-change-the-laravel-public-folder/
        // $this->app->bind('path.public', function () {
        //     return '/var/www/multiplatformphplaravel8v1.syncsystem.com.br/www';
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // config(['app.configDirectoryFilesLayoutSD' => $GLOBALS['configDirectoryFilesLayoutSD']]);
    }
}
