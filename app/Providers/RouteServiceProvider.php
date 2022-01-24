<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $admin = 'App\Http\Controllers\Admin';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';
    public const LOGIN = '/login';
    public const USERS = '/admin/users';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapUsersRoutes();

        $this->mapPostsRoutes();

        $this->mapRolesRoutes();

        $this->mapPermissionsRoutes();

        $this->mapTagsRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/web.php'));
    }

    protected function mapPostsRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->admin)
            ->group(base_path('routes/web/posts.php'));
    }

    protected function mapUsersRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'role:admin'])
            ->namespace($this->namespace) //? u users.php je sve podeseno
            ->group(base_path('routes/web/users.php'));
    }

    protected function mapRolesRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'role:admin'])
            ->namespace($this->admin)
            ->group(base_path('routes/web/roles.php'));
    }

    protected function mapPermissionsRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'auth', 'role:admin'])
            ->namespace($this->admin)
            ->group(base_path('routes/web/permissions.php'));
    }

    protected function mapTagsRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'auth'])
            ->namespace($this->admin)
            ->group(base_path('routes/web/tags.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/api.php'));
    }
}
