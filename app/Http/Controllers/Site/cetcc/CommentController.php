<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\api\CommentModel;
use App\Model\api\BlogModel;

class CommentController extends Controller
{
	public function post(Request $request) {
		$input = $request->all();
		$input['user_id'] = 1;

		if (empty($input['answer_from'])) {
			$input['answer_from'] = null;
		}

		$modelComment = (new CommentModel)->fill($input);

		$modelComment->save();

		$blogModel = BlogModel::find($input['blog_id']);
		$blogModel->count_comments += 1;
		$blogModel->save();

		return redirect()->back();
	}

	public function getByBlog(Request $request, $blogId) {
		return CommentModel::getByBlog($blogId)->toArray();
	}
}
