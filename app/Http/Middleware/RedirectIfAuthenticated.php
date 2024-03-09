<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->except('json'))
                    return $this->apiSuccessMessage(__('base.you_are_login_before'));
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
