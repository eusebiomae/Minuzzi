<?php

namespace App\Http\Controllers\StudentArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class _Controller extends Controller {
	function __construct() {
		if (!Session::has('company')) {
			$company = \App\Model\api\SchoolInformationModel::withTrashed()->with('state')->first();
			Session::put('company', $company);
		}
	}

	function save($data, $Model) {

		$input = [];

		foreach($data as $key => $value) {
			$input[$key] = empty($value) ? null : $value;
		}

		$toInsert = empty($input['id']);
		if ($toInsert) {
			$toSave = new $Model;
		} else {
			$toSave = $Model::find($input['id']);
		}

		$toSave->fill($input);
		$toSave->save();

		return $toSave;
	}

	function disable(Request $request, $id) {
		$data = $this->apiModel::select('id', 'updated_at', 'deleted_at')->find($id);

		if(!$data) {
			return response()->json([
				'error' => [
					'message' => 'Record not found',
				],
			], 404);
		}

		$data->delete();

		return $data;
	}

	function enable(Request $request, $id) {
		$data = $this->apiModel::select('id', 'updated_at', 'deleted_at')->withTrashed()->find($id);

		if(!$data) {
			return response()->json([
				'error' => [
					'message' => 'Record not found',
				],
			], 404);
		}

		$data->restore();

		return $data;
	}

	public function runUpload(Request $request, $id)
	{
		// if ($request->hasFile('files')) {
		// 	$file = $request->file('files');
		// 	$extension = strtolower($file->getClientOriginalExtension());
		// 	$mimeType = $file->getMimeType();
		// 	$fileName = $file->getClientOriginalName();
		// 	$fileNameSave = uniqid();

		// 	$request->file('files')->move("public/files_uploaded/", $fileNameSave);

		// 	return $this->save([
		// 		'table' => $this->apiModel->getTable(),
		// 		'table_id' => $id,
		// 		'identifier' => $request->get('identifier'),
		// 		'name' => $fileName,
		// 		'file' => $fileNameSave,
		// 		'extension' => $extension,
		// 		'mime_type' => $mimeType,
		// 	], new FileUploadedModel);
		// }

		return null;
	}
}
