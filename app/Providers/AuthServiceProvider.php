<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', function (User $user) {
            return $user->hasAnyRole(['admin']);
      });


        Gate::define('edit-users', function (User $user) {
            return $user->hasAnyRole(['admin', 'auteur']);
      });
      Gate::define('delete-users', function (User $user) {
        return $user->isAdmin();
  });
    }
}
