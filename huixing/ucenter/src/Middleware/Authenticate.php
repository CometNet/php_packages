<?php

namespace Huixing\UCenter\Middleware;

use Closure;
use Huixing\UCenter\Facades\UCenter;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $redirectTo = ucenter_base_path(config('ucenter.auth.redirect_to', 'auth/login'));
        if (UCenter::guard()->guest() && !$this->shouldPassThrough($request)) {
            return redirect()->guest($redirectTo);
        }
        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        $excepts = array_merge(config('ucenter.auth.excepts', []), [
            'auth/login',
            'auth/logout'
        ]);
        return collect($excepts)
            ->map('ucenter_base_path')
            ->contains(function ($except) use ($request) {
                if ($except !== '/') {
                    $except = trim($except, '/');
                }

                return $request->is($except);
            });
    }
}
