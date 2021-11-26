<?php

namespace App\Http\Controllers\StudentArea;

use Illuminate\Support\Facades\Auth;
use App\Model\api\Configuration\StateModel;
use App\Model\api\StudentModel;
use Illuminate\Http\Request;

class AccountDataController extends _Controller {
	public function index() {
		return view('student_area/account_data/index')
		->with('payload', [
			'student' => StudentModel::find(Auth::guard('studentArea')->user()->id),
			'states' => StateModel::orderBy('abbreviation')->get(),
		]);
	}

	public function toSave(Request $request) {
		$this->saveData($request);

		return redirect()->back();
	}

	public function saveData(Request $request) {
		if (!$request->get('kids')) {
		$request['kids'] = null;
		}

		$input = $request->all();


		if (isset($input['password'])) {
			$input['password'] = \Illuminate\Support\Facades\Hash::make($input['password']);
		} else {
			unset($input['password']);
		}

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/student', $fileName);
			$input['image'] = $fileName;
		}

		return parent::save($input, StudentModel::class);
	}

	public function loginRegister(Request $request) {
		$credentials = [];
		if ($request->get('identification')) {
			$key = preg_match('/@/', $request['identification']) ? 'email' : 'cpf';

			$student = StudentModel::where($key, $request['identification'])->first();

			if ($student) {
				$credentials[$key] = $request['identification'];
				$credentials['password'] = $request['password'];

				return Auth::guard('studentArea')->attempt($credentials, true) ? Auth::guard('studentArea')->user() : ['codeRequest' => '_345'];
			} else {
				return ['codeRequest' => '_345'];
			}
		} else {
			$cpf = preg_replace('/\D/', '', $request['cpf']);

			$student = StudentModel::where('email', $request['email'])->first();

			if ($student) {
				$credentials['email'] = $request['email'];
				$credentials['password'] = $request['password'];

				if (Auth::guard('studentArea')->attempt($credentials, true)) {
					return Auth::guard('studentArea')->user();
				} else
				if (Auth::guard('studentArea')->attempt([ 'email' => $request['email'], 'password' => $cpf ], true)) {
					$student->update([ 'password' => \Illuminate\Support\Facades\Hash::make($request->password) ]);
					return Auth::guard('studentArea')->user();
				} else {
					return ['codeRequest' => '_335'];
				}
			} else {
				$credentials['email'] = $request['email'];
				$credentials['password'] = $request['password'];

				$request['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
				parent::save($request->all(), StudentModel::class);

				return Auth::guard('studentArea')->attempt($credentials, true) ? Auth::guard('studentArea')->user() : ['codeRequest' => '_300'];
			}
		}
	}
}
