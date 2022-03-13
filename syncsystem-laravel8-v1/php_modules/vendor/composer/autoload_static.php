<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit34b9edd026877ca91c2f8165b7357af1
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SyncSystemNS\\' => 13,
        ),
        'D' => 
        array (
            'Database\\Seeders\\' => 17,
            'Database\\Factories\\' => 19,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SyncSystemNS\\' => 
        array (
            0 => __DIR__ . '/../../..' . '/components_php/syncsystem-ns',
        ),
        'Database\\Seeders\\' => 
        array (
            0 => __DIR__ . '/../../..' . '/database/seeders',
        ),
        'Database\\Factories\\' => 
        array (
            0 => __DIR__ . '/../../..' . '/database/factories',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Console\\Kernel' => __DIR__ . '/../../..' . '/app/Console/Kernel.php',
        'App\\Exceptions\\Handler' => __DIR__ . '/../../..' . '/app/Exceptions/Handler.php',
        'App\\Http\\Controllers\\AdminCategoriesController' => __DIR__ . '/../../..' . '/app/Http/Controllers/AdminCategoriesController.php',
        'App\\Http\\Controllers\\ApiCategoriesController' => __DIR__ . '/../../..' . '/app/Http/Controllers/ApiCategoriesController.php',
        'App\\Http\\Controllers\\ApiCategoriesListingController' => __DIR__ . '/../../..' . '/app/Http/Controllers/ApiCategoriesListingController.php',
        'App\\Http\\Controllers\\Controller' => __DIR__ . '/../../..' . '/app/Http/Controllers/Controller.php',
        'App\\Http\\Controllers\\FrontendCategoriesListingController' => __DIR__ . '/../../..' . '/app/Http/Controllers/FrontendCategoriesListingController.php',
        'App\\Http\\Kernel' => __DIR__ . '/../../..' . '/app/Http/Kernel.php',
        'App\\Http\\Middleware\\Authenticate' => __DIR__ . '/../../..' . '/app/Http/Middleware/Authenticate.php',
        'App\\Http\\Middleware\\EncryptCookies' => __DIR__ . '/../../..' . '/app/Http/Middleware/EncryptCookies.php',
        'App\\Http\\Middleware\\PreventRequestsDuringMaintenance' => __DIR__ . '/../../..' . '/app/Http/Middleware/PreventRequestsDuringMaintenance.php',
        'App\\Http\\Middleware\\RedirectIfAuthenticated' => __DIR__ . '/../../..' . '/app/Http/Middleware/RedirectIfAuthenticated.php',
        'App\\Http\\Middleware\\TrimStrings' => __DIR__ . '/../../..' . '/app/Http/Middleware/TrimStrings.php',
        'App\\Http\\Middleware\\TrustHosts' => __DIR__ . '/../../..' . '/app/Http/Middleware/TrustHosts.php',
        'App\\Http\\Middleware\\TrustProxies' => __DIR__ . '/../../..' . '/app/Http/Middleware/TrustProxies.php',
        'App\\Http\\Middleware\\VerifyCsrfToken' => __DIR__ . '/../../..' . '/app/Http/Middleware/VerifyCsrfToken.php',
        'App\\Models\\CategoriesListing' => __DIR__ . '/../../..' . '/app/Models/CategoriesListing.php',
        'App\\Models\\User' => __DIR__ . '/../../..' . '/app/Models/User.php',
        'App\\Providers\\AppServiceProvider' => __DIR__ . '/../../..' . '/app/Providers/AppServiceProvider.php',
        'App\\Providers\\AuthServiceProvider' => __DIR__ . '/../../..' . '/app/Providers/AuthServiceProvider.php',
        'App\\Providers\\BroadcastServiceProvider' => __DIR__ . '/../../..' . '/app/Providers/BroadcastServiceProvider.php',
        'App\\Providers\\EventServiceProvider' => __DIR__ . '/../../..' . '/app/Providers/EventServiceProvider.php',
        'App\\Providers\\RouteServiceProvider' => __DIR__ . '/../../..' . '/app/Providers/RouteServiceProvider.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Database\\Factories\\UserFactory' => __DIR__ . '/../../..' . '/database/factories/UserFactory.php',
        'Database\\Seeders\\DatabaseSeeder' => __DIR__ . '/../../..' . '/database/seeders/DatabaseSeeder.php',
        'SyncSystemNS\\ObjectCategoriesListing' => __DIR__ . '/../../..' . '/components_php/syncsystem-ns/ObjectCategoriesListing.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit34b9edd026877ca91c2f8165b7357af1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit34b9edd026877ca91c2f8165b7357af1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit34b9edd026877ca91c2f8165b7357af1::$classMap;

        }, null, ClassLoader::class);
    }
}