<?php

namespace App\Http\Middleware;

use Closure;

class InjectTypeLeads
{
	public function handle($request, Closure $next, $guard = '')
	{
		if (!isset($request['flg_type'])) {
			switch ($guard) {
				case 'P':
					$request['flg_type'] = 'P';
					$request['flgType'] = 'prospect';
					break;
				case 'C':
					$request['flg_type'] = 'C';
					$request['flgType'] = 'client';
					break;
				case 'X':
					$request['flg_type'] = 'X';
					$request['flgType'] = 'former_client';
					break;
			}
		}

		return $next($request);
	}
}
