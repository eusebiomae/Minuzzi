<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\api\ContentPage;

class ContentPageController extends Controller {
  public function index() {
		$data = ContentPage::with('content')->get();
		return response()->json($data);
	}

  public function store(Request $request) {
		$contentPage = new ContentPage();
		$contentPage->fill($request->all());
		$contentPage->save();

		return response()->json($contentPage, 201);
	}
}
