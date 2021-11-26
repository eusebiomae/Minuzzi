<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\BlogModel;

use App\Model\api\Configuration\BlogCategoryModel;
use App\Model\api\Configuration\BlogsTagsModel;
use App\Model\api\Configuration\BlogTagModel;

use Illuminate\Support\Facades\DB;

//use DB;

class BlogController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = BlogModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/blog',
			'urlAction' => '/admin/blog/save',
			'pathView'  => 'admin.pages.blog',
			'pathViewInclude'  => 'admin.pages.blog.form',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Gestão Site',
				],
				[
					'url' => '/admin/blog',
					'label' => 'Blog',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->blogCategory = (new BlogCategoryModel())->get();
		$list->author = DB::table('user')->where('author', 'S')->get();
		$list->status = BlogModel::getStatusList();
		$list->blogTag = BlogTagModel::get();
		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.pages.blog';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Blog';
		$this->config->contentTitle = 'Lista de Blogs';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],
			[ 'title' => 'Categoria', 'data' => 'category.description_pt', ],
			[ 'title' => 'Data', 'data' => 'scheduling_date', ],
			[ 'title' => 'Autor', 'data' => 'author.name', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		// $dataTableB = new \stdClass();
		// $dataTableA = new \stdClass();

		// return $data = BlogModel::withTrashed()->with([
		// 	'category',
		// 	'author',
		// ])->get();

		// $mapData = [
		// 	'blog' => [],
		// 	'article' => [],
		// ];

		// for ($i = 0, $ii = count($data); $i < $ii; $i++) {
		// 	$item = $data[$i];

		// 	$mapData[$item->category->flg_type][] = $item;
		// }
		// $dataTableA->data = $mapData['article'];
		// $dataTableB->data = $mapData['blog'];

		// $this->config->toView['dataTableA'] = $dataTableA;
		// $this->config->toView['dataTableB'] = $dataTableB;

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'category',
				'author',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Blog';
		$this->config->contentTitle = 'Criar novo Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];
		return parent::insert($request)
			->with('listSelectBox', $this->getListSelectBox())
			->with('payload', null);
	}

	public function update(Request $request) {
		$this->config->title = 'Editar Blog';
		$this->config->contentTitle = 'Alterar Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];
		// $blogsTags = BlogsTagsModel::select('id', 'blog_tag_id')->where('blog_id', $request->id)->with([
		// 	'tags' => function ($query) {
		// 		$query->select('id', 'description');
		// 	}
		// ])->get();

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::with(['blogTag'])->find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/blog', $fileName);
			$request['image'] = $fileName;
		}

		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$saveData = parent::save($request);
		$saveData->blogTag()->sync($request->get('tags'));

		return redirect($this->config->urlBase);
	}

	public function removeTags(Request $request) {
		return BlogsTagsModel::where('id', $request->id)->delete();
	}
}
