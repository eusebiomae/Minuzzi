<?php

namespace App\Http\Controllers\api\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\api\ContentSectionModel;

class ContentSectionController extends Controller {
	public function index() {
		$data = (new ContentSectionModel())->get();
		return response()->json($data);
	}

	public function getByContentPage(Request $request, $id) {
		$data = ContentSectionModel::where('content_page_id', $id)->get();
		return response()->json($data);
	}
}
