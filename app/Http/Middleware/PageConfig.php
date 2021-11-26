<?php

namespace App\Http\Middleware;

use Closure;
use GigaGetData;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;

class PageConfig
{
	public function handle($request, Closure $next, $guard = '')
	{
		$pageConfGuard = explode(':', $guard);

		$pageKey = toCamelCase($pageConfGuard[0]);

		$pagesUserProfile = GigaGetData::getPageConfig($pageKey);

		if ($pagesUserProfile) {
			$request['pageConfig'] = $pagesUserProfile;

			return $next($request);
		}

		// print_r($pageConfGuard);die;
		return redirect('/admin');
	}
}
