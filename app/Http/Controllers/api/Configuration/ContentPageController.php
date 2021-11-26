<?php

namespace App\Http\Controllers\api\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\api\ContentPageModel;

class ContentPageController extends Controller {
	public function index() {
		$data = (new ContentPageModel())->get();
		return response()->json($data);
	}


}
