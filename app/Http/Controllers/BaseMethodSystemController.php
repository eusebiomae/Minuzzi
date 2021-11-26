<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BaseMethodSystemController extends Controller {

	public function index() {
		return $this->list(new Request());
	}

	function list(Request $request) {
		$view = view($this->config->pathView . '/' . (isset($this->config->fileView) && !empty($this->config->fileView) ? $this->config->fileView : 'list'));

		if (isset($this->config->toView) && is_array($this->config->toView)) {
			foreach ($this->config->toView as $key => $value) {
				$view->with($key, $value);
			}
		}

		$view->with('urlAction', '/' . $this->config->urlAction . '/save')
		->with('fileView', (isset($this->config->fileView) ? $this->config->fileView : ''));

		return $view;
	}

	public function insert(Request $request) {
		$view = view($this->config->pathView . '/' . (isset($this->config->fileView) && !empty($this->config->fileView) ? $this->config->fileView : 'form'))
		->with('urlAction', '/' . $this->config->urlAction . '/save')
		->with('data', (isset($this->apiModel) ? normalizeColunsToViewOld($this->apiModel->fillable) : new \stdClass()));

		if (isset($this->config->toView) && is_array($this->config->toView)) {
			foreach ($this->config->toView as $key => $value) {
				$view->with($key, $value);
			}
		}

		return $view->with('fileView', $this->config->fileView);
	}

	public function update(Request $request) {
		$view = view($this->config->pathView . '/' . (isset($this->config->fileView) && !empty($this->config->fileView) ? $this->config->fileView : 'form'))
		->with('urlAction', '/' . $this->config->urlAction . '/save');

		if ($request->id) {
			$data = $this->apiModel::find($request->id)->toArray();

			if ($data) {
				$view->with('data', $this->normalizeToView((object) $data));
			}
		}

		if (isset($this->config->toView) && is_array($this->config->toView)) {
			foreach ($this->config->toView as $key => $value) {
				$view->with($key, $value);
			}
		}

		return $view->with('fileView', $this->config->fileView);
	}

	function save(Request $request) {
		$paramsConfig = [
			'redirectBack' => true
		];

		if (is_null($request->paramsConfig)) {
			$request->paramsConfig = [];
		}

		$paramsConfig = (object) array_merge($paramsConfig, $request->paramsConfig);

		$input = $this->normalizeToSave($request->all());

		foreach($input as $key => $value) {
			$input[$key] = empty($value) ? null : $value;
		}

		$toInsert = empty($input['id']);

		if ($toInsert) {
			$toSave = $this->apiModel;
		} else {
			$toSave = $this->apiModel::find($input['id']);
		}

		$toSave->fill($input);
		$toSave->save();

		if ($toSave->id) {

		}

		if ($paramsConfig->redirectBack) {
			return redirect()->back();
		}

		return (object) [
			'action' => $toInsert ? 'I' : 'U',
			'data' => $toSave,
		];
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

	protected function normalizeToSave($data) {
		foreach($data as $key => &$val) {

			if (in_array($key, $this->apiModel->fillable)) {
				if (isset($this->apiModel->columns) && isset($this->apiModel->columns->{$key})) {
					switch ($this->apiModel->columns->{$key}->type) {
						case 'date':
						if (!empty($val)) {
							$val = empty($val) ? null : preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $val);
						}
						break;

						default:
						break;
					}
				}
			} else {
				if ($key !== 'id') {
					unset($data[$key]);
				}
			}
		}

		return $data;
	}

	private function normalizeToView($data) {

		foreach($data as $key => &$val) {
			if (isset($this->apiModel->columns) && isset($this->apiModel->columns->{$key})) {
				switch ($this->apiModel->columns->{$key}->type) {
					case 'date':
					if (!empty($val)) {
						$val = empty($val) ? null : preg_replace('/(\d{4})\-(\d{2})\-(\d{2})/', '$3/$2/$1', $val);
					}
					break;

					default:
					break;
				}
			}

		}

		return $data;
	}
}
