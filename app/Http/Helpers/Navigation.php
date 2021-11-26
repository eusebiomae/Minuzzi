<?php

use Illuminate\Support\Facades\Route;

function isActiveRoute($route, $output = 'active') {

	if ((is_array($route) && in_array(Route::currentRouteName(), $route)) || Route::currentRouteName() == $route) {
		return $output;
	}
}
