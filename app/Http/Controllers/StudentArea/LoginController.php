<?php

namespace App\Http\Controllers\StudentArea;

use App\Model\api\Configuration\PhraseModel;
use App\Model\api\Configuration\StateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Model\api\StudentModel;
use Illuminate\Support\Facades\Auth;

class LoginController extends _Controller {

	protected function guard() {
		return Auth::guard('studentArea');
	}

	public function index(Request $request) {

		return view('student_area.login.login')
		->with('payload', [
			'states' => StateModel::all(),
			'phrases' => PhraseModel::all(),
		]);
	}

	public function login(Request $request) {
		$this->validate($request, [
			'identification' => 'required|min:3',
			'password' => 'required|min:3',
		]);

		$credentials = [ 'password' => $request->password, ];

		$credentials[preg_match('/@/', $request->identification) ? 'email' : 'cpf'] = $request->identification;

		if (Auth::guard('studentArea')->attempt($credentials, true)) {
			return redirect(route('studentArea.dashboard'));
		}

		return redirect()->back()->withInput([ 'codeResponse' => 400 ]);
	}

	public function logout(Request $request) {
		$this->guard()->logout();
		return redirect('/');
	}

	public function register(Request $request) {
		$input = $request->all();

		$withInput = [ 'codeResponse' => '402' ];

		$student = StudentModel::where('email', $input['email'])->orWhere('cpf', $input['cpf'])->first();

		if (!$student) {
			$request['password'] = Hash::make($request->password);
			$request['email_confirmation_code'] = 'studentArea-' . generate_uuid();
			$dataSaved = parent::save($request->all(), StudentModel::class);

			if (isset($dataSaved->id)) {
				\Illuminate\Support\Facades\Mail::to($dataSaved->email)->send(new \App\Mail\EmailConfirmationMail($dataSaved));

				$withInput['codeResponse'] = '202';
			}
		}

		return redirect()->back()->withInput($withInput);
	}

	public function resetSendEmail(Request $request) {
		$withInput = [ 'codeResponse' => 401 ];

		if ($request->get('identification')) {
			$user = StudentModel::where('email', $request->identification)->orWhere('cpf', $request->identification)->first();

			if ($user) {
				$withInput['codeResponse'] = 201;

				$resetPasswordCode = 'studentArea-' . generate_uuid();

				$user->update([ 'reset_password_code' => $resetPasswordCode ]);

				\Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($user));
			}
		}

		return redirect()->back()->withInput($withInput);
	}

	public function resetPassword(Request $request) {
		$studentModel = StudentModel::where('reset_password_code', $request->get('resetPasswordCode'))->first();

		if ($studentModel) {
			$studentModel->update([
				'reset_password_code' => null,
				'password' => Hash::make($request->password),
			]);
		}

		return redirect('student_area/login');
	}
}
