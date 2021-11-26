<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;

class SearchController extends _Controller
{

	public function search(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$contentPage = ContentPageModel::getByComponent($flgPage);

		foreach ($contentPage->contentSection as &$contentSection) {
			if ($contentSection->component == 'search') {
				unset($contentSection->content);

				$course = \App\Model\api\Prospection\CourseModel::query();
				$blogModel = \App\Model\api\BlogModel::query();

				if ($request->get('search')) {
					$search = "%{$request->get('search')}%";

					$course->orWhere('title_pt', 'like', $search)->orWhere('description_pt', 'like', $search);

					$blogModel->where(function($query) use ($search) {
						$query->where('title_pt', 'like', $search)->orWhere('subtitle_pt', 'like', $search)->orWhere('text_pt', 'like', $search);
					})->where('status', 'AT');
				}

				$blog = (clone $blogModel)->whereHas('category', function($query) {
					$query->where('flg_type', 'blog');
				});

				$article = (clone $blogModel)->whereHas('category', function($query) {
					$query->where('flg_type', 'article');
				});

				$contentSection->content = (object) [
					'course' => $course->get(),
					'blog' => $blog->get(),
					'article' => $article->get(),
				];
			}
		}
		// return $contentSection;
		return view('site/cetcc/pages/default')
			->with('flgPage', $flgPage)
			->with('search', $request->get('search'))
			->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('pageComponents', $contentPage)
			->with('footerLinks', $this->generateFooterLinks());
	}
}
