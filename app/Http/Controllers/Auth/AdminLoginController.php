<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth, Session;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller {
	public function __construct() {
		$this->middleware(
			'guest:admin',
			[
				'except' => [
					'logout',
					'login',
					'showLoginForm',
					'showForgotpasswordForm',
				]
			]
		);
	}

	public function showLoginForm() {
		return view('auth.admin-login');
		// ->with('pass', Hash::make('admin'));
	}

	public function showForgotpasswordForm() {
		return view('auth.forgot-password');
	}

	public function login(Request $request) {

		$this->validate($request, [
			'user_name' => 'required|min:5',
			'password' => 'required|min:5',
			]
		);

		$credentials = [
			'user_name' => $request->user_name,
			'password' => $request->password,
		];

		$remember = $request->get('remember');

		if (Auth::guard('admin')->attempt($credentials, $remember)) {
			return redirect()->intended(route('admin.dashboard'));
		}

		return redirect()->back()->withInput($request->only('user_name', 'remember'));
	}

	public function logout(Request $request) {
		Auth::guard('admin')->logout();

		$request->session()->flush();
		$request->session()->regenerate();

		return redirect()->route('admin.login');
	}

}
