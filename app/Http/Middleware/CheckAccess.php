<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, \Closure $next, $model)
    {
        // Récupérer la route actuelle
        $route = request()->route();


        // Mapper l'action de la base de données au verbe HTTP standard

        if (!Gate::allows('access',  $model)) {
            return response('Vous n\'avez pas les autorisations nécessaires pour accéder à cette ressource.', 403);
        }
        return $next($request);
    }
}
