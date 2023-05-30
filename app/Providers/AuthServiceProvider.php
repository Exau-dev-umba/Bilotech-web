<?php
namespace App\Providers;
// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate::define('manage-users', function (User $user) {
        //     return $user->hasAnyRole(['Admin', 'project owner']);
        // });
        Gate::define('access', function (User $user2, $model) {
            $user_id = Auth::user()->id;
             $actionMap = [
                'post' => 'create',
                'get' => 'read',
                'put' => 'update',
                'patch' => 'update',
                'delete' => 'delete',
            ];

            $role = User::find($user_id)->roles()->first()->id; 
            $action = $_SERVER['REQUEST_METHOD'];
            $action = strtolower($action);

            if (isset($actionMap[$action])) {
                $action = $actionMap[$action];
            }

            $check = DB::table('role_police')->where('model', $model)->where('action', $action)->where('role_id', $role)->select('id')->count();
            // print_r($check);
            // die($model);
            
            if (($check > 0)) {
                return true; // l'utilisateur a les autorisations nécessaires
            }else {
            return false; // l'utilisateur n'a pas les autorisations nécessaires

}
        });
    }
}




