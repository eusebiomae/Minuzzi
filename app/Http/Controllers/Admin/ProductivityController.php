<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\ProductivityModel;
use App\Model\api\ProductivityContentModel;
use Illuminate\Support\Facades\Auth;

class ProductivityController extends BaseMethodController {

	function __construct() {
		$this->apiModel = new ProductivityModel();

		$this->config = (object) [
			'pathView' => 'admin/productivity',
			'urlAction' => 'admin/routine_management/productivity',
		];
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';
		$dataTable = new \stdClass();
		$list = ProductivityModel::withTrashed()->with('user');

		if (Auth::user()->admin != 'S') {
			$list->where('user_id', Auth::user()->id);
		}

		$dataTable->data = $list->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Data',
				'column' => 'date',
			],
			(object) [
				'label' => 'Dia da semana',
				'column' => 'weekdayLabel',
			],
			(object) [
				'label' => 'Titúlo',
				'column' => 'title',
			],
			(object) [
				'label' => 'Usuário',
				'column' => 'user.name',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request)
		->with('params', $request->all());
	}

	function insert(Request $request) {
		return parent::insert($request);
	}

	function update(Request $request) {
		return parent::update($request)
		->with('productivityContent', ProductivityContentModel::where('productivity_id', $request->id)->get());
	}

	function save(Request $request) {
		$request['user_id'] = Auth::user()->id;

		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		if ($request->get('productivityContent')) {
			$productivityContents = [
				'ins' => [],
				'upd' => [],
			];

			foreach ($request->get('productivityContent') as $productivityContent) {
				if (empty($productivityContent['id'])) {
					if (!empty($productivityContent['content'])) {
						$productivityContents['ins'][] = new ProductivityContentModel($productivityContent);
					}
				} else {
					$productivityContentModel = ProductivityContentModel::where('id', $productivityContent['id']);

					if (empty($productivityContent['content'])) {
						$productivityContentModel->delete();
					} else {
						unset($productivityContent['id']);
						$productivityContentModel->update($productivityContent);
					}
				}
			}

			if (count($productivityContents['ins'])) {
				$save->data->productivityContent()->saveMany($productivityContents['ins']);
			}
		}

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
		} else {
			return redirect()->back();
		}
	}

}
