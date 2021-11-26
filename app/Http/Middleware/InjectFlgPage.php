<?php

namespace App\Http\Middleware;

use Closure;

class InjectFlgPage
{
	public function handle($request, Closure $next, $guard = '')
	{
		$request['flgPage'] = $guard;

		return $next($request);
	}
}
