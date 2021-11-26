<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\api\Content;

class ContentController extends Controller {
	public function index() {
		$data = Content::with('contentPage')->get();
		return response()->json($data);
	}

	public function show($id) {
		$data = Content::find($id);

		if(!$data) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		return response()->json($data);
	}

	public function store(Request $request) {
		$content = new Content();
		$content->fill($request->all());
		$content->save();

		return response()->json($content, 201);
	}

	public function update(Request $request, $id) {
		$content = Content::find($id);

		if(!$content) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		$content->fill($request->all());
		$content->save();

		return response()->json($content);
	}

	public function destroy($id) {
		$content = Content::find($id);

		if(!$content) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		$content->delete();
	}
}
