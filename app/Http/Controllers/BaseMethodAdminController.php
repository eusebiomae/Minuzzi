<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BaseMethodAdminController extends Controller {

	public function view(Request $request) {
		if (!isset($this->config->btnTopRight)) {
			$this->config->btnTopRight = [
				[
					'url' => $this->config->urlBase,
					'label' => 'Visualizar',
					'icon' => 'fa fa-view',
					'class' => 'btn-primary',
				],
			];
		}

		$view = view('admin.components.view')->with('config', $this->config);

		return $view;
	}

	public function list(Request $request) {
		if (!isset($this->config->btnTopRight)) {
			$this->config->btnTopRight = [
				[
					'url' => $this->config->urlBase . '/insert',
					'label' => 'Novo',
					'icon' => 'fa fa-plus',
					'class' => 'btn-primary',
				],
			];
		}

		$view = view($this->config->pathView . "{$this->config->fileView}")
		->with('config', $this->config);

		return $view;
	}

	public function getListEnableDisable($opts) {
		$dataTableEnable = new \stdClass();
		$dataTableEnable->data = $opts->apiModel->get();
		$dataTableEnable->header = $opts->dataTableHeader;

		$dataTableDisable = new \stdClass();
		$dataTableDisable->data = $opts->apiModel->onlyTrashed()->get();
		$dataTableDisable->header = $opts->dataTableHeader;

	 	return [
			'enable' => $dataTableEnable,
			'disable' => $dataTableDisable,
		];
	}

	public function insert(Request $request) {
		if (!isset($this->config->btnTopRight)) {
			$this->config->btnTopRight = [
				[
					'url' => $this->config->urlBase,
					'label' => 'Lista',
					'icon' => 'fa fa-list',
					'class' => 'btn-primary',
				],
			];
		}

		$view = view(isset($this->config->pathViewDefault) ? $this->config->pathViewDefault : 'admin.components.form')
		->with('config', $this->config);

		return $view;
	}

	public function update(Request $request) {
		if (!isset($this->config->btnTopRight)) {
			$this->config->btnTopRight = [
				[
					'url' => $this->config->urlBase,
					'label' => 'Lista',
					'icon' => 'fa fa-list',
					'class' => 'btn-primary',
				],
			];
		}

		$view = view(isset($this->config->pathViewDefault) ? $this->config->pathViewDefault : 'admin.components.form')->with('config', $this->config);

		return $view;
	}

	public function save(Request $request) {
		if ($request->get('id')) {
			$apiModel = $this->apiModel::find($request->get('id'));

			if (!$apiModel) {
				$apiModel = new $this->apiModel;
			}
		} else {
			$apiModel = new $this->apiModel;
		}

		$apiModel->fill($request->all())->save();

		if (isset($request->paramsConfig['redirectBack']) && !$request->paramsConfig['redirectBack']) {
			return $apiModel;
		}

		return redirect($this->config->urlBase);
	}

	function delete(Request $request, $id) {
		$data = $this->apiModel::find($id);

		if(!$data) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		$data->delete();

		return redirect()->back();
	}

	function enable(Request $request, $id) {
		$data = $this->apiModel::withTrashed()->find($id);

		if(!$data) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		$data->restore();

		return redirect()->back();
	}
}
