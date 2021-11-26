<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\api\BlogModel;
use App\Model\api\CommentModel;
use App\Model\api\Configuration\BlogCategoryModel;
use App\Model\api\CorrespondingCourseCategoryModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$slides = SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->first();

		$posts = BlogModel::select(
			'id',
			'image',
			'label_image_pt AS label_image',
			'title_pt AS title',
			'subtitle_pt AS subtitle',
			'text_pt AS text',
			'blog_category_id',
			'author_post',
			'user_cad_id',
			'count_likes',
			'count_views',
			'count_comments',
			'created_by',
			'updated_by',
			'created_at',
			'updated_at'
		)
		->where('status', 'AT')
		->whereHas('category', function($query) use ($flgPage) {
			$query->where('flg_type', $flgPage);
		})
		->with([
			'category' => function ($query) {
				$query->select('id', 'description_pt AS description', 'flg_type');
			},
			'author' => function ($query) {
				$query->select('id', 'name', 'image');
			},
		]);

		if ($request->get('view')) {
			switch ($request->get('view')) {
				case 'views':
				$posts->orderBy('count_views', 'desc');
				break;
				case 'likes':
					$posts->orderBy('count_likes', 'desc');
				break;
			}
		} else {
			$posts->orderBy('created_at', 'desc');
		}

		$categories = $request->get('categories');
		if (!isset($categories['all']) && isset($categories['c'])) {
			$posts->whereIn('blog_category_id', $categories['c']);
		}

		if (!empty($request->get('search'))) {
			$search = $request->get('search');

			$posts->where(function($query) use ($search) {
				$query
				->orWhere('title_pt', 'like', "%{$search}%")
				->orWhere('subtitle_pt', 'like', "%{$search}%")
				->orWhere('text_pt', 'like', "%{$search}%");
			});
		}

		if ($request->get('tags')) {
			$posts->whereHas('blogsTags', function($query) use ($request) {
				$query->whereIn('blog_tag_id', $request->get('tags'));
			});
		}

		$categories = BlogCategoryModel::getCategoryCountBlog([
			'flgType' => $flgPage,
		]);

		return view('site/cetcc/pages/blog')
			->with('title', BlogCategoryModel::labelFlgType($flgPage))
			->with('flgPage', $flgPage)
			->with('params', $request->all())
			->with('posts', $posts->paginate(15)->setPath('/blog'))
			->with('categories', $categories)
			->with('sidebarCard', $this->getSidebarCard([
				'flgType' => $flgPage,
			]))
			->with('popularTags', BlogModel::getPopularTags())
			->with('banner', $slides)
			->with('footerLinks', $this->generateFooterLinks($categories));
		}

	public function getPost(Request $request, $id)
	{
		$flgPage = $request->get('flgPage');

		$post = BlogModel::select(
			'id',
			'image',
			'label_image_pt AS label_image',
			'title_pt AS title',
			'subtitle_pt AS subtitle',
			'text_pt AS text',
			'blog_category_id',
			'author_post',
			'user_cad_id',
			'count_likes',
			'count_views',
			'count_comments',
			'created_by',
			'updated_by',
			'created_at',
			'updated_at'
		)
		->with([
			'category' => function ($query) {
				$query->select('id', 'description_pt AS description');
			},
			'author' => function ($query) {
				$query->select('id', 'name', 'image');
			},
		])->find($id);

		$post->count_views += 1;

		$post->save();

		$categories = BlogCategoryModel::getCategoryCountBlog([
			'flgType' => $flgPage,
		]);

		return view('site/cetcc/pages/blog_page')
		->with('title', BlogCategoryModel::labelFlgType($flgPage))
		->with('flgPage', $flgPage)
		->with('post', $post)
		->with('comments', CommentModel::getByBlog($id))
		->with('categories', $categories)
		->with('sidebarCard', $this->getSidebarCard([
			'flgType' => $flgPage,
			'post' => $post,
		]))
		->with('popularTags', BlogModel::getPopularTags())
		->with('footerLinks', $this->generateFooterLinks($categories))
		->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->first());
	}

	public function liked(Request $request, $id, $liked)
	{
		$update = BlogModel::find($id);

		$update->fill([
			'count_likes' => $update->count_likes + ($liked === 'true' ? 1 : -1),
		]);

		return $update->save() ? 'OK' : null;
	}

	public function generateFooterLinks($categories)
	{
		$footerLinks = [];

		for ($i = 0, $ii = count($categories); $i < $ii; $i++) {
			$item = $categories[$i];

			$footerLinks[] = [
				'url' => "/blog?categories[c][]={$item->id}",
				'label' => $item->description,
			];
		}

		return [
			'title' => 'Categorias',
			'links' => $footerLinks,
		];
	}

	private function getSidebarCard($opts) {
		$recentPosts = BlogModel::getRecentPosts([
			'flgType' => $opts['flgType'],
			'count' => 5,
		]);

		$sidebarCard = [
			'recentPosts' => [
				'title' => 'Posts Recentes',
				'cards' => [],
			],
			'recommendedCourse' => [
				'title' => 'Cursos recomendados',
				'cards' => [],
			],
		];

		foreach ($recentPosts as $item) {
			$sidebarCard['recentPosts']['cards'][] = (object) [
				'title' => $item->title,
				'link' => "/blog/{$item->id}/" . urlencode($item->title),
				'image' => "/storage/blog/{$item->image}",
				'date' => $item->created_at,
			];
		}

		if (isset($opts['post'])) {

			$post = $opts['post'];

			$recommendedCourse = CourseModel::whereHas('correspondingCourseCategory', function($query) use ($post) {
				$query->where('blog_category_id', $post->blog_category_id);
			})->get();

			foreach ($recommendedCourse as $item) {
				$sidebarCard['recommendedCourse']['cards'][] = (object) [
					'title' => $item->title_pt,
					'link' => "/course/{$item->id}",
					'image' => $item->img,
					'date' => $item->start_date,
				];
			}
		}

		return $sidebarCard;
	}
}
