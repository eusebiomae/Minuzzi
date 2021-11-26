<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\Configuration\PhraseModel;

class PhraseController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = PhraseModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/phrase',
			'urlAction' => '/admin/phrase/save',
			'pathView'  => 'admin.pages.phrase',
			'pathViewInclude'  => 'admin.pages.phrase.form',
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
					'url' => '/admin/phrase',
					'label' => 'Frases',
				],
			],
		];
	}

	// Modelo ListSelectBox
	private function getListSelectBox() {
		$list = (object) [];

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Frases';
		$this->config->contentTitle = 'Lista de frases da área do aluno';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Frase', 'data' => 'phrase', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Frase';
		$this->config->contentTitle = 'Criar nova frase para área do aluno';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Frase';
		$this->config->contentTitle = 'Alterar frase da área do aluno';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());
			$request->file('fileImage')->move('storage/phrase', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}
}
