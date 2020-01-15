<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        dd($request);
        if (auth()->user() == null) {
            echo 'Пользователь не авторизован в системе';
            abort(404);
        }
         echo 'ROLE='.$role.' PERM='.$permission;
        if (auth()->user()->hasRole($role)) {
            echo "Пользователь авторизован, но не имеет роль $role";
            abort(404);
        }

        if ($permission !== null && auth()->user()->can($permission)) {
            echo "Пользователь авторизован, но не права $permission";
            abort(404);
        }
        return $next($request);
    }
}
