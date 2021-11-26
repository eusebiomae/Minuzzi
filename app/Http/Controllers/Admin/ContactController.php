<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\ContactModel;

use File;

class ContactController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = ContactModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/contact',
			'urlAction' => '/admin/contact/save',
			'pathView'  => 'admin.pages.contentPage',
			// 'pathViewInclude'  => 'admin.pages.contact.form',
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
					'url' => '/admin/contentpage',
					'label' => 'Contato',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		// $list->contentPage = (new ContentPageModel())->get();
		// $list->contentSection = [];

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Informações Contato';
		$this->config->contentTitle = 'Lista de Informações Contato';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Site', 'data' => 'site', ],
			[ 'title' => 'E-mail', 'data' => 'email', ],
			[ 'title' => 'Telefone', 'data' => 'phone', ],
			[ 'title' => 'Assunto', 'data' => 'subject', ],
			[ 'title' => 'Mesagem', 'data' => 'description_pt', 'className' => 'cut-text',],

			// [ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

}
