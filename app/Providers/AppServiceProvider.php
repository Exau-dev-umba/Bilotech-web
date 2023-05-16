<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function(QueryExecuted $query) {
            $user = null ;
            File::append(
                storage_path('/logs/query.log'),
                $query->sql . ' [' . implode(', ', $query->bindings) . ']' . '[' . $query->time . ']' . '[]'  . PHP_EOL
                
                
           );
        });
    }
}
