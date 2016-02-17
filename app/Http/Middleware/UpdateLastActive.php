<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Updates the last active property on a user.
 *
 * @package App\Http\Middleware
 */
class UpdateLastActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() !== null) {
            $request->user()->updateLastActive();
        }

        return $next($request);
    }
}
