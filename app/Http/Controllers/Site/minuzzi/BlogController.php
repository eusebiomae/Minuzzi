<?php

namespace App\Http\Controllers\Site\minuzzi;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Http\Controllers\Controller;
use App\Model\api\BlogModel;

use App\Model\api\Configuration\BlogCategoryModel;
use App\Model\api\Configuration\BlogsTagsModel;
use App\Model\api\ContentPageModel;
use Illuminate\Support\Facades\DB;

//use DB;

class BlogController extends Controller {

	    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

				$blogs = BlogModel::get();

				$events = BlogModel::get();

        // return $blogs;
        return view('site/pages/default')
        ->with('flgPage', $flgPage)
        ->with('pageComponents', $pageComponents)
				->with('events', $events)
				->with('blogs', $blogs);
    }

		public function getPost(Request $request, $id) {

			$flgPage = $request->get('flgPage');

			$pageComponents = ContentPageModel::getByComponent($flgPage);

			$blog = BlogModel::find($id);

			// return $blog;

			return view ('site/pages/blog_details')
			->with('flgPage', $flgPage)
			->with('pageComponents', $pageComponents)
			->with('blog', $blog);
		}

	function __construct() {
		$this->pageKey = 'blogPost';

		$this->apiModel = new BlogModel();

		$this->config = (object) [
			'pathView' => 'admin/blog',
			'urlAction' => 'admin/blog',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->blogCategory = (new BlogCategoryModel())->get();
		$list->author = DB::table('user')->where('author', 'S')->get();
		$list->status = BlogModel::getStatusList();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTableB = new \stdClass();
		$dataTableA = new \stdClass();

		$data = BlogModel::withTrashed()->with([
			'category',
			'author',
		])->get();

		$mapData = [
			'blog' => [],
			'article' => [],
		];

		for ($i = 0, $ii = count($data); $i < $ii; $i++) {
			$item = $data[$i];

			// $mapData[$item->category->flg_type][] = $item;
			$mapData['blog'][] = $item;
		}

		$dataTableA->header = $dataTableB->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Título',
				'column' => 'title_pt',
			],
			(object) [
				'label' => 'Categoria',
				'column' => 'category',
			],
			(object) [
				'label' => 'Data',
				'column' => 'created_at',
			],
			// (object) [
			// 	'label' => 'Autor',
			// 	'column' => 'author.name',
			// ],
		];

		$dataTableA->data = $mapData['article'];
		$dataTableB->data = $mapData['blog'];

		$this->config->toView['dataTableA'] = $dataTableA;
		$this->config->toView['dataTableB'] = $dataTableB;
		// print_r($dataTableA);
		// die;

		return parent::list($request);
	}

	function insert(Request $request) {
		return parent::insert($request)
			->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$blogsTags = BlogsTagsModel::select('id', 'blog_tag_id')->where('blog_id', $request->id)->with([
			'tags' => function ($query) {
				$query->select('id', 'description');
			}
		])->get();

		return parent::update($request)
			->with('blogsTags', $blogsTags)
			->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		$tags = explode(',', $request->get('tags'));

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$path = $request->file('fileImage')->move('storage/blog', $fileName);
			$request['image'] = $fileName;
		}

		$request->paramsConfig = [
			'redirectBack' => false,
		];

		// print_r($request->all());die;
		$save = parent::save($request);

		$tagsSave = [];
		for ($i = count($tags) - 1; $i > -1; $i--) {
			if (!empty($tags[$i])) {
				$tagsSave[] = [
					'blog_id' => $save->data['id'],
					'blog_tag_id' => $tags[$i],
				];
			}
		}

		BlogsTagsModel::where('blog_id', $save->data['id'])->delete();
		if (count($tagsSave)) {
			BlogsTagsModel::insert($tagsSave);
		}

		return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
	}

	public function removeTags(Request $request) {
		return BlogsTagsModel::where('id', $request->id)->delete();
	}
}
